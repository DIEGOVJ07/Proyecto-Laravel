<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        /* 1. Configuración de la página para eliminar márgenes blancos extra */
        @page {
            margin: 0;
            size: a4 landscape;
        }

        body {
            font-family: 'Helvetica', sans-serif;
            margin: 0;
            padding: 0;
        }

        /* 2. Contenedor con posición absoluta para respetar los bordes sin saltar de página */
        .container {
            position: absolute;
            top: 20px;
            left: 20px;
            right: 20px;
            bottom: 20px;
            border: 10px solid #10b981; /* Borde Verde Neón */
            text-align: center;
            background-color: #fff;
        }

        /* Contenido interno */
        .content-wrapper {
            padding: 40px;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 30px;
        }

        .title {
            font-size: 42px;
            font-weight: bold;
            color: #10b981;
            text-transform: uppercase;
            margin: 0;
            line-height: 1;
        }

        .subtitle {
            font-size: 18px;
            color: #555;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        /* Nombre del Ganador */
        .recipient {
            font-size: 40px;
            font-weight: bold;
            color: #000;
            margin: 15px auto;
            border-bottom: 2px solid #ddd;
            display: inline-block;
            padding-bottom: 5px;
            min-width: 50%;
        }

        .description {
            font-size: 16px;
            color: #666;
            margin-bottom: 15px;
        }

        .event-name {
            font-weight: bold;
            color: #10b981;
            font-size: 22px;
        }

        .rank-badge {
            margin-top: 10px;
            display: inline-block;
            background-color: #f3f4f6;
            padding: 10px 30px;
            border-radius: 50px;
            border: 1px solid #d1d5db;
        }

        .rank-text {
            font-size: 20px;
            font-weight: bold;
            color: #d97706; /* Color Dorado/Ambar */
        }

        /* Pie de página y Firma */
        .footer {
            margin-top: 50px;
            width: 100%;
        }

        .signature-box {
            width: 300px;
            margin: 0 auto;
            text-align: center;
        }

        .signature-img {
            font-family: 'Times New Roman', serif;
            font-style: italic;
            font-size: 28px;
            color: #000;
            margin-bottom: 5px;
        }

        .signature-line {
            border-top: 1px solid #333;
            margin-bottom: 5px;
        }

        .organizer-name {
            font-weight: bold;
            font-size: 14px;
            text-transform: uppercase;
        }

        .role {
            font-size: 12px;
            color: #777;
        }

        .meta-info {
            position: absolute;
            bottom: 10px;
            width: 100%;
            text-align: center;
            font-size: 9px;
            color: #9ca3af;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="content-wrapper">
            <div class="logo">CodeBattle Platform</div>
            
            <div class="title">Certificado de Reconocimiento</div>
            <div class="subtitle">Se otorga el presente diploma a:</div>

            <div class="recipient">{{ $user->name }}</div>

            <div class="description">
                Por su destacada participación y habilidades técnicas demostradas en el evento:
                <br>
                <span class="event-name">"{{ $contest->name }}"</span>
            </div>

            <div class="rank-badge">
                <span class="rank-text">POSICIÓN OBTENIDA: #{{ $rank }}</span>
            </div>

            <div class="footer">
                <div class="signature-box">
                    {{-- Firma simulada (Texto cursiva) --}}
                    <div class="signature-img">
                        {{ $organizerName }}
                    </div>
                    
                    <div class="signature-line"></div>
                    <div class="organizer-name">{{ $organizerName }}</div>
                    <div class="role">Organizador del Evento</div>
                </div>
            </div>
        </div>

        <div class="meta-info">
            Fecha de emisión: {{ date('d/m/Y') }} • ID Verificación: {{ $contest->id }}-{{ $user->id }}-{{ Str::upper(Str::random(5)) }}
        </div>
    </div>
</body>
</html>