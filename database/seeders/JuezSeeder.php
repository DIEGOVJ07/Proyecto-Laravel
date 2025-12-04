<?php

namespace Database\Seeders;

use App\Models\Judge;
use Illuminate\Database\Seeder;

class JuezSeeder extends Seeder
{
    public function run(): void
    {
        $judges = [
            [
                'name' => 'Dr. Carlos Méndez',
                'email' => 'carlos.mendez@codebattle.com',
                'phone' => '+52 951 123 4567',
                'specialty' => 'Algoritmos',
                'institution' => 'UNAM',
                'experience_years' => 15,
                'bio' => 'Doctor en Ciencias de la Computación con especialización en algoritmos y complejidad computacional. Ha sido juez en más de 50 competencias internacionales incluyendo ICPC y Google Code Jam.',
                'certification_level' => 'Expert',
                'is_active' => true,
            ],
            [
                'name' => 'Dra. Ana Rodríguez',
                'email' => 'ana.rodriguez@codebattle.com',
                'phone' => '+52 951 234 5678',
                'specialty' => 'Estructuras de Datos',
                'institution' => 'IPN',
                'experience_years' => 12,
                'bio' => 'Experta en estructuras de datos avanzadas y optimización de algoritmos. Profesora titular en el IPN y juez certificada en competencias de ACM.',
                'certification_level' => 'Expert',
                'is_active' => true,
            ],
            [
                'name' => 'Ing. Roberto Sánchez',
                'email' => 'roberto.sanchez@codebattle.com',
                'phone' => '+52 951 345 6789',
                'specialty' => 'Programación Dinámica',
                'institution' => 'ITESM',
                'experience_years' => 8,
                'bio' => 'Ingeniero en Software con maestría en Computación. Especializado en programación dinámica y algoritmos de optimización. Juez activo en Codeforces y HackerRank.',
                'certification_level' => 'Senior',
                'is_active' => true,
            ],
            [
                'name' => 'Mtra. Laura Fernández',
                'email' => 'laura.fernandez@codebattle.com',
                'phone' => '+52 951 456 7890',
                'specialty' => 'Grafos',
                'institution' => 'UAM',
                'experience_years' => 10,
                'bio' => 'Maestra en Ciencias Computacionales especializada en teoría de grafos y algoritmos de redes. Ha evaluado más de 30 competencias nacionales.',
                'certification_level' => 'Senior',
                'is_active' => true,
            ],
            [
                'name' => 'Ing. Miguel Torres',
                'email' => 'miguel.torres@codebattle.com',
                'phone' => '+52 951 567 8901',
                'specialty' => 'Inteligencia Artificial',
                'institution' => 'CINVESTAV',
                'experience_years' => 6,
                'bio' => 'Investigador en inteligencia artificial y machine learning. Juez junior con experiencia en competencias de IA y data science.',
                'certification_level' => 'Junior',
                'is_active' => true,
            ],
            [
                'name' => 'Dr. Eduardo Vargas',
                'email' => 'eduardo.vargas@codebattle.com',
                'phone' => '+52 951 678 9012',
                'specialty' => 'Matemáticas',
                'institution' => 'UABJO',
                'experience_years' => 14,
                'bio' => 'Doctor en Matemáticas Aplicadas. Experto en algoritmos numéricos y teoría de números aplicada a la programación competitiva.',
                'certification_level' => 'Expert',
                'is_active' => true,
            ],
            [
                'name' => 'Ing. Patricia Luna',
                'email' => 'patricia.luna@codebattle.com',
                'phone' => '+52 951 789 0123',
                'specialty' => 'Bases de Datos',
                'institution' => 'Universidad Tecnológica',
                'experience_years' => 5,
                'bio' => 'Ingeniera en Sistemas con especialización en bases de datos y optimización de queries. Juez junior en competencias de SQL y diseño de bases de datos.',
                'certification_level' => 'Junior',
                'is_active' => true,
            ],
            [
                'name' => 'Ing. Francisco Morales',
                'email' => 'francisco.morales@codebattle.com',
                'phone' => '+52 951 890 1234',
                'specialty' => 'Desarrollo Web',
                'institution' => 'Freelance',
                'experience_years' => 7,
                'bio' => 'Desarrollador web full-stack con amplia experiencia en competencias de desarrollo rápido y hackathons. Juez certificado en eventos de frontend y backend.',
                'certification_level' => 'Senior',
                'is_active' => true,
            ],
        ];

        foreach ($judges as $judgeData) {
            Judge::create($judgeData);
        }
    }
}