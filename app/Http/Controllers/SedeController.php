<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SedeController extends Controller
{
    public function index()
    {
        $sedes = [
            [
                'id' => 1,
                'name' => 'Campus Tech Central',
                'address' => 'Av. Insurgentes Sur 1582, Ciudad de México',
                'type' => 'building', // Para poner el icono de edificio
                'capacity' => 500,
                'next_events' => 2,
                'features' => [
                    ['icon' => 'wifi', 'text' => 'WiFi de alta velocidad'],
                    ['icon' => 'parking', 'text' => 'Estacionamiento'],
                    ['icon' => 'coffee', 'text' => 'Cafetería'],
                    ['icon' => 'ac', 'text' => 'Aire acondicionado'],
                ]
            ],
            [
                'id' => 2,
                'name' => 'Centro de Convenciones Innovation',
                'address' => 'Blvd. Puerta de Hierro 5065, Guadalajara',
                'type' => 'convention', // Icono de columnas/banco
                'capacity' => 800,
                'next_events' => 3,
                'features' => [
                    ['icon' => 'wifi', 'text' => 'WiFi empresarial'],
                    ['icon' => 'parking', 'text' => 'Estacionamiento VIP'],
                    ['icon' => 'rest', 'text' => 'Área de descanso'],
                    ['icon' => 'projector', 'text' => 'Proyectores 4K'],
                ]
            ],
            [
                'id' => 3,
                'name' => 'CodeHub Monterrey',
                'address' => 'Av. Constitución 2050, Monterrey',
                'type' => 'building',
                'capacity' => 350,
                'next_events' => 1,
                'features' => [
                    ['icon' => 'wifi', 'text' => 'Fibra óptica'],
                    ['icon' => 'parking', 'text' => 'Estacionamiento'],
                    ['icon' => 'snack', 'text' => 'Snack bar'],
                    ['icon' => 'gaming', 'text' => 'Mesas gaming'],
                ]
            ],
            [
                'id' => 4,
                'name' => 'Digital Arena Puebla',
                'address' => 'Blvd. 5 de Mayo 3015, Puebla',
                'type' => 'arena', // Icono de Diana/Target
                'capacity' => 400,
                'next_events' => 2,
                'features' => [
                    ['icon' => 'wifi', 'text' => 'Red dedicada'],
                    ['icon' => 'parking', 'text' => 'Estacionamiento'],
                    ['icon' => 'streaming', 'text' => 'Área de streaming'],
                    ['icon' => 'work', 'text' => 'Zonas de trabajo'],
                ]
            ],
        ];

        return view('sedes.index', compact('sedes'));
    }
}