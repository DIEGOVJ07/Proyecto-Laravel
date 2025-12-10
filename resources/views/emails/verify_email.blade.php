<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; background-color: #0f111a; margin: 0; padding: 0; }
        .container { width: 100%; max-width: 600px; margin: 0 auto; background-color: #151a25; border: 1px solid #2c3240; border-radius: 8px; overflow: hidden; }
        .header { background-color: #151a25; padding: 30px; text-align: center; border-bottom: 1px solid #2c3240; }
        .content { padding: 40px 30px; color: #cbd5e1; line-height: 1.6; text-align: center; }
        .button { display: inline-block; padding: 14px 30px; background-color: #10b981; color: #ffffff; text-decoration: none; border-radius: 6px; font-weight: bold; font-size: 16px; margin: 20px 0; text-transform: uppercase; letter-spacing: 1px; }
        .footer { background-color: #0f111a; padding: 20px; text-align: center; font-size: 12px; color: #64748b; }
        .link-alt { color: #10b981; word-break: break-all; font-size: 12px; }
    </style>
</head>
<body>
    <div style="background-color: #0f111a; padding: 40px 0;">
        <div class="container">
            <div class="header">
                <h1 style="color: #ffffff; margin: 0; font-size: 24px;">
                    <span style="color: #10b981;">Code</span>Battle
                </h1>
            </div>

            <div class="content">
                <h2 style="color: #ffffff; margin-top: 0;">¡Verifica tu Correo!</h2>
                
                <p>Hola <strong>{{ $notifiable->name }}</strong>,</p>
                
                <p>Gracias por registrarte en CodeBattle. Para completar tu registro y comenzar a competir, por favor confirma tu dirección de correo electrónico haciendo clic en el siguiente botón:</p>

                <a href="{{ $url }}" class="button">Verificar Correo</a>

                <p style="font-size: 14px; color: #94a3b8;">
                    Si no creaste esta cuenta, no es necesario realizar ninguna acción.
                </p>
            </div>

            <div class="footer">
                <p>&copy; {{ date('Y') }} CodeBattle Platform. Todos los derechos reservados.</p>
                
                <p style="margin-top: 20px; border-top: 1px solid #2c3240; paddingTop: 20px;">
                    Si tienes problemas con el botón, copia y pega este enlace:<br>
                    <a href="{{ $url }}" class="link-alt">{{ $url }}</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>