<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo mensaje de contacto</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background-color: #09090b;
            color: #f4f4f5;
            margin: 0;
            padding: 0;
            -webkit-text-size-adjust: 100%;
        }
        .container {
            max-width: 560px;
            margin: 32px auto;
            padding: 32px 24px;
            background-color: #18181b;
            border-radius: 16px;
            border: 1px solid #27272a;
        }
        .brand {
            border-bottom: 1px solid #27272a;
            padding-bottom: 20px;
            margin-bottom: 24px;
        }
        .brand-badge {
            display: inline-block;
            font-size: 11px;
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #a1a1aa;
            background-color: #27272a;
            padding: 4px 10px;
            border-radius: 9999px;
            margin-bottom: 8px;
        }
        .brand h1 {
            font-size: 20px;
            font-weight: 700;
            color: #ffffff;
            margin: 0;
            letter-spacing: -0.025em;
        }
        .info-grid {
            margin: 20px 0;
            background-color: #27272a;
            border: 1px solid #3f3f46;
            border-radius: 12px;
            overflow: hidden;
        }
        .info-row {
            display: flex;
            border-bottom: 1px solid #3f3f46;
            padding: 12px 16px;
            font-size: 13px;
        }
        .info-row:last-child {
            border-bottom: none;
        }
        .info-label {
            width: 110px;
            color: #a1a1aa;
            font-weight: 500;
            flex-shrink: 0;
        }
        .info-value {
            color: #f4f4f5;
            font-weight: 600;
            word-break: break-all;
        }
        .message-box {
            background-color: #222226;
            border: 1px solid #3f3f46;
            border-radius: 12px;
            padding: 20px;
            margin: 24px 0;
        }
        .message-title {
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #a1a1aa;
            margin-bottom: 10px;
        }
        .message-content {
            font-size: 14px;
            line-height: 1.7;
            color: #e4e4e7;
            white-space: pre-wrap;
            word-break: break-word;
        }
        .button-wrap {
            text-align: center;
            margin: 28px 0 16px;
        }
        .btn {
            display: inline-block;
            background-color: #4f46e5;
            color: #ffffff !important;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 10px;
            transition: background-color 0.2s;
        }
        .footer {
            margin-top: 28px;
            padding-top: 20px;
            border-top: 1px solid #27272a;
            font-size: 11px;
            color: #71717a;
            text-align: center;
            line-height: 1.5;
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="brand">
            <span class="brand-badge">Alejandro Cabeza &middot; Portafolio</span>
            <h1>Nuevo Mensaje de Contacto</h1>
        </div>

        <div class="info-grid">
            <div class="info-row">
                <span class="info-label">Remitente:</span>
                <span class="info-value">{{ $senderName }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Email:</span>
                <span class="info-value">
                    <a href="mailto:{{ $senderEmail }}" style="color: #818cf8; text-decoration: none;">{{ $senderEmail }}</a>
                </span>
            </div>
            <div class="info-row">
                <span class="info-label">Asunto:</span>
                <span class="info-value">{{ $subjectLine }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Fecha / Hora:</span>
                <span class="info-value">{{ $submittedAt }}</span>
            </div>
            @if ($ipAddress)
                <div class="info-row">
                    <span class="info-label">Dirección IP:</span>
                    <span class="info-value">{{ $ipAddress }}</span>
                </div>
            @endif
        </div>

        <div class="message-box">
            <div class="message-title">Mensaje:</div>
            <div class="message-content">{!! nl2br(e($messageContent)) !!}</div>
        </div>

        <div class="button-wrap">
            <a href="mailto:{{ $senderEmail }}?subject={{ rawurlencode('Re: ' . $subjectLine) }}" class="btn">
                Responder a {{ $senderName }}
            </a>
        </div>

        <div class="footer">
            Enviado a través del formulario de contacto del Portafolio Web usando Sendrix Gateway.
            <br>
            Puedes responder directamente a este correo para escribirle a {{ $senderEmail }}.
        </div>
    </div>
</body>
</html>
