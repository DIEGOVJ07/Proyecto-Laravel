<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::with('roles');

        // Filtrar por rol si se proporciona
        if ($request->filled('role')) {
            $query->role($request->role);
        }

        // Buscar por nombre o email
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query->latest()->paginate(15);
        $roles = Role::all();

        return view('admin.usuarios.index', compact('users', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.usuarios.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'exists:roles,name'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        $user->assignRole($request->role);

        return redirect()->route('admin.usuarios.index')
            ->with('success', 'Usuario creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $user->load(['roles', 'contestRegistrations', 'leaderboard']);
        return view('admin.usuarios.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        // Proteger super_admins de ser editados por otros
        if ($user->hasRole('super_admin') && !Auth::user()->hasRole('super_admin')) {
            abort(403, 'No puedes editar un Super Administrador.');
        }

        $roles = Role::all();
        return view('admin.usuarios.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // Proteger super_admins
        if ($user->hasRole('super_admin') && !Auth::user()->hasRole('super_admin')) {
            abort(403, 'No puedes editar un Super Administrador.');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'role' => ['required', 'exists:roles,name'],
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        // Sincronizar rol
        $user->syncRoles([$request->role]);

        return redirect()->route('admin.usuarios.index')
            ->with('success', 'Usuario actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Proteger super_admins
        if ($user->hasRole('super_admin')) {
            abort(403, 'No puedes eliminar un Super Administrador.');
        }

        // No permitir auto-eliminación
        if ($user->id === Auth::id()) {
            abort(403, 'No puedes eliminar tu propia cuenta desde aquí.');
        }

        $user->delete();

        return redirect()->route('admin.usuarios.index')
            ->with('success', 'Usuario eliminado exitosamente.');
    }

    /**
     * Cambiar el estado de un usuario (activar/suspender)
     */
    public function toggleStatus(User $user)
    {
        // Proteger super_admins
        if ($user->hasRole('super_admin') && !Auth::user()->hasRole('super_admin')) {
            abort(403, 'No puedes modificar el estado de un Super Administrador.');
        }

        $user->update([
            'is_active' => !$user->is_active
        ]);

        $status = $user->is_active ? 'activado' : 'suspendido';

        return redirect()->back()
            ->with('success', "Usuario {$status} exitosamente.");
    }

    /**
     * Asignar rol a un usuario
     */
    public function assignRole(Request $request, User $user)
    {
        $request->validate([
            'role' => ['required', 'exists:roles,name'],
        ]);

        // Proteger super_admins
        if ($user->hasRole('super_admin') && !Auth::user()->hasRole('super_admin')) {
            abort(403, 'No puedes cambiar el rol de un Super Administrador.');
        }

        $user->syncRoles([$request->role]);
        $user->update(['role' => $request->role]);

        return redirect()->back()
            ->with('success', 'Rol asignado exitosamente.');
    }
}
