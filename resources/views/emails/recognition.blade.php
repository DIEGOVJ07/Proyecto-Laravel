<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Arial', sans-serif; background-color: #f4f4f4; color: #333; padding: 20px; }
        .certificate-container {
            background-color: #fff;
            border: 5px solid #10b981; /* Verde CodeBattle */
            padding: 40px;
            text-align: center;
            max-width: 600px;
            margin: 0 auto;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .header { font-size: 24px; font-weight: bold; color: #10b981; margin-bottom: 10px; text-transform: uppercase; }
        .award-icon { font-size: 50px; margin-bottom: 20px; }
        .recipient { font-size: 28px; font-weight: bold; margin: 20px 0; color: #1f2937; }
        .event-name { font-size: 20px; font-style: italic; color: #4b5563; }
        .rank { font-size: 22px; font-weight: bold; color: #d97706; margin: 15px 0; }
        .footer { margin-top: 40px; border-top: 1px solid #ddd; pt: 20px; font-size: 14px; color: #666; }
        .signature { margin-top: 30px; font-weight: bold; font-size: 18px; }
    </style>
</head>
<body>
    <div class="certificate-container">
        <div class="header">Reconocimiento Oficial</div>
        
        <div class="award-icon">🏆</div>

        <p>Se otorga el presente reconocimiento a:</p>
        
        <div class="recipient">{{ $user->name }}</div>

        <p>Por su destacada participación en el evento:</p>
        
        <div class="event-name">"{{ $contest->name }}"</div>

        <div class="rank">
            Obteniendo el lugar: #{{ $rank }}
        </div>

        <div class="signature">
            __________________________<br>
            {{ $organizerName }}<br>
            <span style="font-size: 12px; font-weight: normal;">Organizador del Evento</span>
        </div>

        <div class="footer">
            &copy; {{ date('Y') }} CodeBattle Platform.
        </div>
    </div>
</body>
</html>