<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VenueController extends Controller
{
    public function index()
    {
        $venues = [
            [
                'id' => 1,
                'name' => 'Universidad Autónoma Benito Juárez de Oaxaca',
                'acronym' => 'UABJO',
                'address' => 'Av. Universidad s/n, Ex Hacienda 5 Señores',
                'city' => 'Oaxaca de Juárez, Oaxaca',
                'capacity' => 500,
                'upcoming_events' => 3,
                'image' => '🎓',
                'features' => [
                    'WiFi de alta velocidad',
                    'Auditorio principal',
                    'Laboratorios de cómputo',
                    'Estacionamiento',
                    'Cafetería',
                    'Aire acondicionado'
                ],
                'lat' => 17.0542,
                'lng' => -96.7236,
                'events' => [
                    ['name' => 'CodeBattle Regional 2025', 'date' => '15 Ene 2025', 'participants' => 120],
                    ['name' => 'Hackathon UABJO', 'date' => '22 Ene 2025', 'participants' => 80],
                    ['name' => 'Workshop de IA', 'date' => '5 Feb 2025', 'participants' => 45],
                ]
            ],
            [
                'id' => 2,
                'name' => 'Instituto Tecnológico de Oaxaca',
                'acronym' => 'ITO',
                'address' => 'Av. Ing. Víctor Bravo Ahuja No. 125',
                'city' => 'Oaxaca de Juárez, Oaxaca',
                'capacity' => 400,
                'upcoming_events' => 2,
                'image' => '🏛️',
                'features' => [
                    'Red dedicada',
                    'Salas de conferencias',
                    'Equipo audiovisual',
                    'Área de networking',
                    'Zonas verdes'
                ],
                'lat' => 17.0594,
                'lng' => -96.7247,
                'events' => [
                    ['name' => 'Torneo de Algoritmos', 'date' => '18 Ene 2025', 'participants' => 95],
                    ['name' => 'Competencia de Robótica', 'date' => '28 Ene 2025', 'participants' => 60],
                ]
            ],
            [
                'id' => 3,
                'name' => 'Universidad Tecnológica de los Valles Centrales',
                'acronym' => 'UTVCO',
                'address' => 'Carretera a San Pablo Huixtepec Km 12.5',
                'city' => 'Santa Cruz Xoxocotlán, Oaxaca',
                'capacity' => 350,
                'upcoming_events' => 2,
                'image' => '💻',
                'features' => [
                    'Centro de cómputo',
                    'Fibra óptica',
                    'Proyectores 4K',
                    'Área de descanso',
                    'Estacionamiento VIP'
                ],
                'lat' => 17.0333,
                'lng' => -96.7333,
                'events' => [
                    ['name' => 'Code Sprint Challenge', 'date' => '25 Ene 2025', 'participants' => 70],
                    ['name' => 'Desarrollo Web Avanzado', 'date' => '8 Feb 2025', 'participants' => 55],
                ]
            ],
            [
                'id' => 4,
                'name' => 'Universidad del Istmo',
                'acronym' => 'UNISTMO',
                'address' => 'Ciudad Universitaria s/n, Barrio Santa Cruz',
                'city' => 'Tehuantepec, Oaxaca',
                'capacity' => 300,
                'upcoming_events' => 1,
                'image' => '🏫',
                'features' => [
                    'Aulas inteligentes',
                    'WiFi empresarial',
                    'Mesas de trabajo',
                    'Cafetería premium',
                    'Transporte disponible'
                ],
                'lat' => 16.3167,
                'lng' => -95.2500,
                'events' => [
                    ['name' => 'Desafío de Programación', 'date' => '12 Feb 2025', 'participants' => 85],
                ]
            ],
            [
                'id' => 5,
                'name' => 'Universidad La Salle Oaxaca',
                'acronym' => 'ULSA',
                'address' => 'Calzada Porfirio Díaz 404',
                'city' => 'Oaxaca de Juárez, Oaxaca',
                'capacity' => 450,
                'upcoming_events' => 3,
                'image' => '🎯',
                'features' => [
                    'Infraestructura moderna',
                    'Red de 1 Gbps',
                    'Auditorio climatizado',
                    'Snack bar',
                    'Seguridad 24/7'
                ],
                'lat' => 17.0708,
                'lng' => -96.7203,
                'events' => [
                    ['name' => 'Maratón de Programación', 'date' => '20 Ene 2025', 'participants' => 110],
                    ['name' => 'Taller de Ciberseguridad', 'date' => '3 Feb 2025', 'participants' => 50],
                    ['name' => 'Concurso de Apps Móviles', 'date' => '15 Feb 2025', 'participants' => 65],
                ]
            ],
            [
                'id' => 6,
                'name' => 'Universidad Regional del Sureste',
                'acronym' => 'URSE',
                'address' => 'Carretera Oaxaca-Istmo Km 8',
                'city' => 'Oaxaca de Juárez, Oaxaca',
                'capacity' => 280,
                'upcoming_events' => 1,
                'image' => '🚀',
                'features' => [
                    'Campus moderno',
                    'WiFi de alta velocidad',
                    'Área de coworking',
                    'Estacionamiento amplio',
                    'Zona de food trucks'
                ],
                'lat' => 17.0400,
                'lng' => -96.6800,
                'events' => [
                    ['name' => 'Bootcamp Intensivo', 'date' => '1 Feb 2025', 'participants' => 75],
                ]
            ],
        ];

        return view('sedes.index', compact('venues'));
    }

    public function show($id)
    {
        // Aquí puedes agregar lógica para mostrar una sede específica
        return redirect()->route('venues.index');
    }
}