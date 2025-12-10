<?php

namespace App\Http\Controllers;

use App\Models\Contest;
use App\Models\ContestRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContestRecognitionMail;
use Barryvdh\DomPDF\Facade\Pdf;

class ContestController extends Controller
{
    /**
     * Mostrar detalles del concurso
     */
    public function show($id)
    {
        // 1. Cargamos el concurso y sus resultados
        $contest = Contest::with(['leaderboardParticipants' => function($query) {
            $query->orderByPivot('points', 'desc');
        }])->findOrFail($id);
        
        // 2. Preparamos las variables del Ranking
        $topUsers = $contest->leaderboardParticipants;
        $hallOfFame = $topUsers->take(3);
        $userPosition = null;

        // 3. Lógica de registro (¡Actualizada para miembros!)
        $isRegistered = false;
        $registration = null;
        
        if (Auth::check()) {
            $user = Auth::user();
            // Buscamos si el usuario es líder O miembro de algún equipo en este concurso
            $registration = ContestRegistration::where('contest_id', $id)
                ->where(function($q) use ($user) {
                    $q->where('user_id', $user->id) // Es líder
                      ->orWhereHas('members', function($sq) use ($user) {
                          $sq->where('user_id', $user->id); // Es miembro
                      });
                })
                ->first();

            $isRegistered = $registration !== null;
            $userPosition = $topUsers->firstWhere('id', Auth::id());
        }
        
        return view('concursos.show', [
            'event' => $contest, 
            'isRegistered' => $isRegistered,
            'registration' => $registration,
            'hallOfFame' => $hallOfFame,
            'topUsers' => $topUsers,
            'userPosition' => $userPosition
        ]);
    }

    /**
     * Registrar equipo
     */
    public function register(Request $request, $id)
    {
        $request->validate([
            'team_name' => 'required|string|max:255',
            'max_members' => 'required|integer|min:1|max:10',
        ]);

        $contest = Contest::findOrFail($id);

        // Verificamos si ya es parte de algún equipo (líder o miembro)
        $existingRegistration = ContestRegistration::where('contest_id', $id)
            ->where(function($q) {
                $q->where('user_id', Auth::id())
                  ->orWhereHas('members', function($sq) {
                      $sq->where('user_id', Auth::id());
                  });
            })
            ->first();

        if ($existingRegistration) {
            return back()->with('error', 'Ya estás registrado en este concurso (como líder o miembro).');
        }

        $registration = ContestRegistration::create([
            'user_id' => Auth::id(),
            'contest_id' => $id,
            'team_name' => $request->team_name,
            'team_code' => ContestRegistration::generateTeamCode(),
            'is_public' => $request->has('is_public'),
            'max_members' => $request->max_members,
            'current_members' => 1,
            'team_leader_id' => Auth::id(),
            'is_team_leader' => true,
            'status' => 'registered',
            'team_size' => 1,
            'team_members' => [],
        ]);

        $contest->increment('participants');

        return redirect()->route('leaderboard.index')
            ->with('success', '¡Equipo creado exitosamente! Tu código es: ' . $registration->team_code);
    }

    /**
     * Cancelar registro
     */
    public function cancelRegistration($id)
    {
        // Solo el líder (user_id) puede eliminar el equipo completo
        $registration = ContestRegistration::where('user_id', Auth::id())
            ->where('contest_id', $id)
            ->firstOrFail();

        $contest = $registration->contest;
        $registration->delete();

        if ($contest->participants > 0) {
            $contest->decrement('participants');
        }

        return redirect()->back()->with('success', 'Registro cancelado exitosamente');
    }

    /**
     * Generar y Enviar Certificado PDF (Líderes y Miembros)
     */
    public function requestCertificate($id)
    {
        $user = auth()->user();
        $contest = Contest::findOrFail($id);

        // 1. Buscar el registro del equipo
        // AHORA: Busca si el usuario es líder (user_id) O si está en la lista de miembros
        $registration = ContestRegistration::where('contest_id', $id)
            ->where(function($q) use ($user) {
                $q->where('user_id', $user->id) // Si es el líder
                  ->orWhereHas('members', function($subQ) use ($user) {
                      $subQ->where('user_id', $user->id); // Si es miembro
                  });
            })
            ->first();

        // 2. Validaciones
        if (!$registration) {
            return back()->with('error', 'No se encontró tu registro en este evento.');
        }

        if ($registration->status !== 'qualified') {
            return back()->with('error', 'Tu equipo no clasificó para obtener certificado.');
        }

        // 3. Calcular Ranking Real del EQUIPO
        $rankingIds = ContestRegistration::where('contest_id', $id)
            ->where('score', '>', 0)
            ->orderByDesc('score')
            ->pluck('id')
            ->toArray();

        $rank = array_search($registration->id, $rankingIds) + 1;

        // 4. Generar PDF y Enviar
        try {
            $organizerName = 'CodeBattle Admin'; 
            
            // Datos para el PDF: Usamos el nombre del usuario logueado ($user->name)
            // Así cada miembro recibe el diploma con SU PROPIO nombre.
            $data = [
                'user' => $user,
                'contest' => $contest,
                'rank' => $rank,
                'organizerName' => $organizerName
            ];

            // Generar el PDF en memoria
            $pdf = Pdf::loadView('pdf.certificate', $data)
                      ->setPaper('a4', 'landscape');
            
            $pdfContent = $pdf->output();

            // Enviar correo
            Mail::to($user->email)->send(new ContestRecognitionMail($pdfContent));

            return back()->with('success', '¡Certificado enviado a ' . $user->email . '!');

        } catch (\Exception $e) {
            \Log::error('Error generando certificado: ' . $e->getMessage());
            return back()->with('error', 'Hubo un problema al generar el certificado. Intenta más tarde.');
        }
    }
}