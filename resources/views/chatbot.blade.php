<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Asistente Virtual - Ingeniería de Sistemas UTS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root {
     --uts-blue: #0066A1;
     --uts-green: #A4D233;
     --uts-dark: #2c3e50;
     --uts-gray: #6c757d;
 }

 * {
     margin: 0;
     padding: 0;
     box-sizing: border-box;
     touch-action: manipulation;
 }

 body {
     font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
     background: linear-gradient(180deg, #f8f9fa 0%, #ffffff 100%);
     min-height: 100vh;
 }

 .page-header {
     background: linear-gradient(135deg, #0066A1 0%, #A4D233 100%);
     color: white;
     padding: 2rem 1rem;
     text-align: center;
     box-shadow: 0 4px 20px rgba(0, 102, 161, 0.2);
 }

 .page-header h1 {
     font-size: 2rem;
     font-weight: 800;
     margin-bottom: 0.5rem;
 }

 .page-header p {
     font-size: 1rem;
     opacity: 0.95;
 }

 .badge-info {
     background-color: rgba(255, 255, 255, 0.25);
     backdrop-filter: blur(10px);
     color: white;
     padding: 0.6rem 1.8rem;
     border-radius: 50px;
     display: inline-block;
     font-weight: 700;
     font-size: 0.9rem;
     border: 1px solid rgba(255, 255, 255, 0.3);
     margin-bottom: 1rem;
 }

 .container {
     max-width: 1000px;
     margin: 0 auto;
     padding: 2rem 1rem;
 }


 .info-section {
     background: white;
     border-radius: 20px;
     padding: 2rem;
     margin-bottom: 2rem;
     box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
     border: 1px solid rgba(0, 0, 0, 0.05);
 }

 .info-section h2 {
     color: var(--uts-dark);
     font-size: 1.5rem;
     font-weight: 700;
     margin-bottom: 1rem;
     display: flex;
     align-items: center;
     gap: 0.5rem;
 }

 .info-section p {
     color: var(--uts-gray);
     line-height: 1.7;
     margin-bottom: 0.75rem;
 }

 .chatbot-container {
     max-width: 900px;
     margin: 0 auto;
 }

 .chatbot-window {
     background: white;
     border-radius: 24px;
     box-shadow: 0 10px 60px rgba(0, 0, 0, 0.12);
     overflow: hidden;
     display: flex;
     flex-direction: column;
     height: 650px;
     border: 1px solid rgba(0, 0, 0, 0.08);
 }

 .chatbot-header {
     background: linear-gradient(135deg, #0066A1 0%, #A4D233 100%);
     padding: 1.5rem 2rem;
     display: flex;
     justify-content: space-between;
     align-items: center;
     color: white;
     box-shadow: 0 4px 20px rgba(0, 102, 161, 0.2);
     position: sticky;
     top: 0;
     z-index: 100;
     flex-shrink: 0;
 }

 .chatbot-avatar {
     width: 50px;
     height: 50px;
     background: rgba(255, 255, 255, 0.25);
     backdrop-filter: blur(10px);
     border-radius: 50%;
     display: flex;
     align-items: center;
     justify-content: center;
     margin-right: 1rem;
     font-size: 1.6rem;
     border: 2px solid rgba(255, 255, 255, 0.3);
 }

 .chatbot-info h4 {
     margin: 0;
     font-size: 1.15rem;
     font-weight: 700;
     color: white;
 }

 .chatbot-status {
     display: flex;
     align-items: center;
     font-size: 0.85rem;
     color: rgba(255, 255, 255, 0.9);
     margin-top: 0.2rem;
 }

 .status-dot {
     width: 8px;
     height: 8px;
     background: #2ecc71;
     border-radius: 50%;
     margin-right: 0.4rem;
     animation: blink 2s infinite;
 }

 @keyframes blink {

     0%,
     100% {
         opacity: 1;
     }

     50% {
         opacity: 0.4;
     }
 }

 .btn-chat-action {
     background: rgba(255, 255, 255, 0.2);
     border: none;
     width: 40px;
     height: 40px;
     border-radius: 10px;
     color: white;
     cursor: pointer;
     transition: all 0.2s ease;
     display: flex;
     align-items: center;
     justify-content: center;
     font-size: 1.2rem;
 }

 .btn-chat-action:hover {
     background: rgba(255, 255, 255, 0.3);
     transform: scale(1.05);
 }

 .chatbot-body {
     flex: 1;
     padding: 2rem;
     overflow-y: auto;
     background: #f8f9fa;
     display: flex;
     flex-direction: column;
     gap: 1.25rem;
     -webkit-overflow-scrolling: touch;
 }

 .chatbot-body::-webkit-scrollbar {
     width: 8px;
 }

 .chatbot-body::-webkit-scrollbar-track {
     background: #f1f1f1;
 }

 .chatbot-body::-webkit-scrollbar-thumb {
     background: linear-gradient(180deg, #0066A1 0%, #A4D233 100%);
     border-radius: 10px;
 }

 .chat-message {
     display: flex;
     gap: 0.75rem;
     animation: slideIn 0.3s ease;
 }

 @keyframes slideIn {
     from {
         opacity: 0;
         transform: translateY(10px);
     }

     to {
         opacity: 1;
         transform: translateY(0);
     }
 }

 .message-avatar {
     width: 40px;
     height: 40px;
     border-radius: 50%;
     display: flex;
     align-items: center;
     justify-content: center;
     font-size: 1.2rem;
     flex-shrink: 0;
 }

 .bot-message .message-avatar {
     background: linear-gradient(135deg, #0066A1 0%, #A4D233 100%);
     color: white;
 }

 .user-message .message-avatar {
     background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
     color: white;
 }

 .message-content {
     display: flex;
     flex-direction: column;
     gap: 0.3rem;
     max-width: 70%;
 }

 .user-message {
     flex-direction: row-reverse;
 }

 .user-message .message-content {
     align-items: flex-end;
 }


 .message-bubble {
     padding: 1rem 1.3rem;
     border-radius: 18px;
     line-height: 1.6;
     font-size: 0.95rem;
     word-wrap: break-word;
     word-break: break-word;
     overflow-wrap: break-word;
     hyphens: auto;
     max-width: 100%;
     overflow: hidden;
 }

 .bot-message .message-bubble {
     background: white;
     color: var(--uts-dark);
     border: 1px solid #e8ecf1;
     box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
 }

 .user-message .message-bubble {
     background: linear-gradient(135deg, #0066A1 0%, #005a8f 100%);
     color: white;
 }

 .message-bubble p {
     margin: 0 0 0.5rem 0;
     word-wrap: break-word;
     word-break: break-word;
     overflow-wrap: break-word;
 }

 .message-bubble p:last-child {
     margin-bottom: 0;
 }

 .message-bubble a,
 .message-bubble strong {
     word-break: break-all;
 }

 .message-time {
     font-size: 0.75rem;
     color: #95a5a6;
     padding: 0 0.5rem;
     font-weight: 500;
 }

 .quick-suggestions {
     display: grid;
     grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
     gap: 0.75rem;
     margin-top: 0.5rem;
 }

 .suggestions-label {
     font-size: 0.85rem;
     color: #6c757d;
     font-weight: 600;
     margin-bottom: 0.25rem;
     grid-column: 1 / -1;
 }

 .suggestion-chip {
     background: white;
     border: 2px solid #e8ecf1;
     color: var(--uts-dark);
     padding: 0.75rem 1.1rem;
     border-radius: 14px;
     font-size: 0.9rem;
     font-weight: 500;
     cursor: pointer;
     transition: all 0.3s ease;
     text-align: left;
     display: flex;
     align-items: center;
     box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
 }

 .suggestion-chip:hover {
     background: linear-gradient(135deg, #f8fdf0 0%, #ffffff 100%);
     border-color: #A4D233;
     transform: translateY(-2px);
     box-shadow: 0 4px 15px rgba(164, 210, 51, 0.2);
 }

 .suggestion-chip i {
     font-size: 1.1rem;
     margin-right: 0.5rem;
 }

 .typing-indicator {
     padding: 1rem 1.5rem;
     background: white;
     border-top: 1px solid #e8ecf1;
     display: none;
     align-items: center;
     gap: 0.75rem;
     font-size: 0.85rem;
     color: #6c757d;
 }

 .typing-dots {
     display: flex;
     gap: 0.3rem;
 }

 .typing-dots span {
     width: 8px;
     height: 8px;
     background: #0066A1;
     border-radius: 50%;
     animation: typing 1.4s infinite;
 }

 .typing-dots span:nth-child(2) {
     animation-delay: 0.2s;
 }

 .typing-dots span:nth-child(3) {
     animation-delay: 0.4s;
 }

 @keyframes typing {

     0%,
     60%,
     100% {
         transform: translateY(0);
         opacity: 0.4;
     }

     30% {
         transform: translateY(-10px);
         opacity: 1;
     }
 }

 .chatbot-footer {
     padding: 1.25rem 2rem;
     background: white;
     border-top: 1px solid #e8ecf1;
     position: sticky;
     bottom: 0;
     z-index: 100;
     flex-shrink: 0;
 }

 .chat-input-container {
     display: flex;
     gap: 0.75rem;
     align-items: flex-end;
 }

 .chat-input {
     flex: 1;
     border: 2px solid #e8ecf1;
     border-radius: 18px;
     padding: 0.9rem 1.2rem;
     font-size: 0.95rem;
     resize: none;
     max-height: 120px;
     font-family: inherit;
     transition: all 0.2s ease;
 }

 .chat-input:focus {
     outline: none;
     border-color: #A4D233;
     box-shadow: 0 0 0 3px rgba(164, 210, 51, 0.1);
 }

 .btn-send {
     width: 50px;
     height: 50px;
     background: linear-gradient(135deg, #0066A1 0%, #A4D233 100%);
     border: none;
     border-radius: 14px;
     color: white;
     font-size: 1.3rem;
     cursor: pointer;
     transition: all 0.2s ease;
     display: flex;
     align-items: center;
     justify-content: center;
     flex-shrink: 0;
 }

 .btn-send:hover {
     transform: scale(1.05);
     box-shadow: 0 4px 15px rgba(0, 102, 161, 0.3);
 }

 .btn-send:disabled {
     opacity: 0.5;
     cursor: not-allowed;
 }

 .chat-footer-info {
     margin-top: 0.75rem;
     text-align: center;
 }

 .chat-footer-info small {
     display: flex;
     align-items: center;
     justify-content: center;
     gap: 0.25rem;
     font-size: 0.8rem;
     color: #6c757d;
 }

 input, textarea, select {
  font-size: 16px;
}


.footer-uts {
    background: linear-gradient(135deg, #0066A1 0%, #004d7a 50%, #A4D233 100%);
    color: white;
    padding: 3rem 2rem 1.5rem;
    margin-top: 4rem;
}

.footer-content {
    max-width: 1200px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2.5rem;
    align-items: start;
    padding-bottom: 2rem;
    border-bottom: 1px solid rgba(255, 255, 255, 0.2);
}

.footer-logo {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.uts-logo {
    max-width: 280px;
    height: auto;
    filter: brightness(0) invert(1);
    transition: all 0.3s ease;
}

.uts-logo:hover {
    transform: scale(1.05);
    filter: brightness(0) invert(1) drop-shadow(0 4px 8px rgba(255, 255, 255, 0.3));
}

.footer-info {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.footer-section h4 {
    font-size: 1.2rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    color: #A4D233;
}

.footer-section p {
    font-size: 0.95rem;
    line-height: 1.8;
    margin: 0.3rem 0;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    opacity: 0.95;
}

.footer-section i {
    font-size: 1.1rem;
    color: #A4D233;
}

.footer-social {
    display: flex;
    gap: 1rem;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
}

.social-link {
    width: 45px;
    height: 45px;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.3rem;
    text-decoration: none;
    transition: all 0.3s ease;
}

.social-link:hover {
    background: rgba(164, 210, 51, 0.9);
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(164, 210, 51, 0.4);
    border-color: #A4D233;
}

.footer-bottom {
    max-width: 1200px;
    margin: 0 auto;
    padding-top: 1.5rem;
    text-align: center;
}

.footer-bottom p {
    font-size: 0.9rem;
    margin: 0.4rem 0;
    opacity: 0.9;
}

.footer-tagline {
    font-weight: 700;
    font-size: 1.1rem;
    color: #A4D233;
    margin-top: 0.5rem;
}



 @media (max-width: 768px) {
     * {
         margin: 0;
         padding: 0;
         box-sizing: border-box;
         touch-action: manipulation;
     }

     body {
         width: 100%;
         height: 100vh;
     }

     .chatbot-window {
         height: 550px;
     }

     .chatbot-header {
         padding: 1rem 1.5rem;
         position: sticky;
         top: 0;
         z-index: 100;
     }

     .chatbot-avatar {
         width: 40px;
         height: 40px;
         font-size: 1.3rem;
     }

     .chatbot-info h4 {
         font-size: 1rem;
     }

     .message-content {
         max-width: 80%;
     }

     .quick-suggestions {
         grid-template-columns: 1fr;
     }

     .info-section {
         padding: 1.5rem;
     }

     .chat-message {
         gap: 0.5rem;
         max-width: 100%;
         min-width: 0;
     }

     .message-content {
         max-width: 90%;
         min-width: 0;
         overflow: hidden;
     }

     .bot-message .message-content {
         max-width: 90%;
     }

     .user-message .message-content {
         max-width: 85%;
     }

     .message-bubble {
         padding: 0.9rem 1.1rem;
         font-size: 0.9rem;
         word-wrap: break-word;
         word-break: break-word;
         overflow-wrap: break-word;
         max-width: 100%;
     }

     .message-avatar {
         width: 35px;
         height: 35px;
         font-size: 1rem;
         flex-shrink: 0;
     }

     .chatbot-body {
         padding: 1rem 0.75rem;
         -webkit-overflow-scrolling: touch;
     }

     .chatbot-footer {
         padding: 1rem 1.5rem;
     }

     /* Footer responsive */
     .footer-uts {
         padding: 2rem 1.5rem 1rem;
         margin-top: 2rem;
     }

     .footer-content {
         grid-template-columns: 1fr;
         gap: 2rem;
         text-align: center;
     }

     .uts-logo {
         max-width: 220px;
     }

     .footer-section p {
         justify-content: center;
     }

     .footer-social {
         justify-content: center;
     }

     .footer-bottom p {
         font-size: 0.85rem;
     }
 }
    </style>
</head>

<body>
    <div class="page-header">
        <div class="badge-info">
            <i class="bi bi-robot me-2"></i> Asistente Virtual
        </div>
        <h1>Chat con el Asistente Virtual</h1>
        <p>Facultad de Ingeniería de Sistemas</p>
    </div>

    <div class="container">
        <div class="info-section">
            <h2>
                <i class="bi bi-info-circle-fill"></i>
                Sobre el Asistente Virtual
            </h2>
            <p>
                ¡Bienvenido al asistente virtual de la Facultad de Ingeniería de Sistemas!
                <br>
                Estamos para ayudarte con información académica, trámites y procesos frecuentes.
            </p>
        </div>

        <div class="chatbot-container">
            <div class="chatbot-window">
                <div class="chatbot-header">
                    <div style="display: flex; align-items: center;">
                        <div class="chatbot-avatar">
                            <i class="bi bi-robot"></i>
                        </div>
                        <div class="chatbot-info">
                            <h4>Asistente Virtual UTS</h4>
                            <span class="chatbot-status">
                                <span class="status-dot"></span> En línea
                            </span>
                        </div>
                    </div>
                    <button class="btn-chat-action" onclick="clearChat()" title="Reiniciar conversación">
                        <i class="bi bi-arrow-clockwise"></i>
                    </button>
                </div>

                <div class="chatbot-body" id="chatBody">
                    <div class="chat-message bot-message">
                        <div class="message-avatar">
                            <i class="bi bi-robot"></i>
                        </div>
                        <div class="message-content">
                            <div class="message-bubble">
                                <p>¡Hola! 👋 Soy el asistente virtual de la Facultad de Ingeniería de Sistemas.</p>
                                <p>Para ayudarte mejor, <strong>primero selecciona una categoría</strong> de las
                                    opciones a continuación:</p>
                            </div>
                            <span class="message-time" id="welcomeTime"></span>
                        </div>
                    </div>

                    <div class="quick-suggestions" id="quickSuggestions">
                        <div class="suggestions-label">Selecciona una categoría:</div>
                        <button class="suggestion-chip"
                            onclick="selectCategory('Modalidades de trabajos de grado', 'bi-mortarboard-fill')">
                            <i class="bi bi-mortarboard-fill"></i> Modalidades de trabajos de grado
                        </button>
                        <button class="suggestion-chip"
                            onclick="selectCategory('Registro Saber TyT / Saber Pro', 'bi-person-plus-fill')">
                            <i class="bi bi-person-plus-fill"></i> Registro Saber TyT / Saber Pro
                        </button>
                        <button class="suggestion-chip"
                            onclick="selectCategory('TyT PRO/SABER PRO/ICFES', 'bi-clipboard-check')">
                            <i class="bi bi-clipboard-check"></i> TyT PRO / SABER PRO / ICFES
                        </button>
                         <button class="suggestion-chip"
                            onclick="selectCategory('Incapacidades médicas', 'bi-clipboard2-pulse-fill')">
                            <i class="bi bi-clipboard2-pulse-fill"></i>Incapacidades médicas 
                        </button>
                        <button class="suggestion-chip"
                            onclick="selectCategory('Matrícula / Liquidación', 'bi-cash-coin')">
                            <i class="bi bi-cash-coin"></i> Matrícula / Liquidación
                        </button>
                        <button class="suggestion-chip"
                            onclick="selectCategory('Usuarios / Contraseñas / Correo institucional', 'bi-key-fill')">
                            <i class="bi bi-key-fill"></i> Usuarios / Contraseñas / Correo institucional
                        </button>
                        <button class="suggestion-chip"
                            onclick="selectCategory('Cambio de jornada', 'bi-calendar-week')">
                            <i class="bi bi-calendar-week"></i> Cambio de jornada
                        </button>
                        <button class="suggestion-chip"
                            onclick="selectCategory('Cambios de grupo / Horarios', 'bi-clock-history')">
                            <i class="bi bi-clock-history"></i> Cambios de grupo / Horarios
                        </button>
                        <button class="suggestion-chip"
                            onclick="selectCategory('Descuentos / Única materia', 'bi-percent')">
                            <i class="bi bi-percent"></i> Descuentos / Única materia
                        </button>
                        <button class="suggestion-chip"
                            onclick="selectCategory('Inscripciones al programa', 'bi-pencil-square')">
                            <i class="bi bi-pencil-square"></i> Inscripciones al programa
                        </button>
                        <button class="suggestion-chip"
                            onclick="selectCategory('Documentos de grado', 'bi-file-earmark-text')">
                            <i class="bi bi-file-earmark-text"></i> Documentos de grado
                        </button>
                        <button class="suggestion-chip"
                            onclick="selectCategory('Readmisión / Reingreso', 'bi-arrow-clockwise')">
                            <i class="bi bi-arrow-clockwise"></i> Readmisión / Reingreso
                        </button>
                        <button class="suggestion-chip"
                            onclick="selectCategory('Créditos académicos', 'bi-journal-bookmark')">
                            <i class="bi bi-journal-bookmark"></i> Créditos académicos
                        </button>
                        <button class="suggestion-chip"
                            onclick="selectCategory('Cancelación de semestre', 'bi-x-circle')">
                            <i class="bi bi-x-circle"></i> Cancelación de semestre
                        </button>
                    </div>
                </div>

                <div class="typing-indicator" id="typingIndicator">
                    <div class="typing-dots">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <span>El asistente está escribiendo...</span>
                </div>

                <div class="chatbot-footer">
                    <div class="chat-input-container">
                        <textarea class="chat-input" id="chatInput"
                            placeholder="Primero selecciona una categoría arriba..." rows="2"
                            onkeypress="handleKeyPress(event)" disabled></textarea>
                        <button class="btn-send" id="sendBtn" onclick="sendMessage()" disabled>
                            <i class="bi bi-send-fill"></i>
                        </button>
                    </div>
                    <div class="chat-footer-info">
                        <small>
                            <i class="bi bi-shield-check"></i>
                            Tus mensajes son confidenciales
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <footer class="footer-uts">
        <div class="footer-content">
            <div class="footer-logo">
                <img src="{{ asset('images/logo-uts.png') }}" alt="UTS Logo" class="uts-logo">
            </div>
            <div class="footer-info">
                <div class="footer-section">
                    <h4>Unidades Tecnológicas de Santander</h4>
                    <p>Facultad de Ingeniería de Sistemas</p>
                </div>
                <div class="footer-section">
                    <p><i class="bi bi-geo-alt-fill"></i> Calle de los Estudiantes #9-82<br>Edificio C Piso 2 / Bucaramanga</p>
                    <p><i class="bi bi-envelope-fill"></i> sistemas@correo.uts.edu.co</p>
                </div>
            </div>
            <div class="footer-social">
                <a href="https://www.facebook.com/UnidadesTecnologicasdeSantanderUTS" class="social-link" title="Facebook"><i class="bi bi-facebook"></i></a>
                <a href="https://x.com/Unidades_UTS" class="social-link" title="Twitter"><i class="bi bi-twitter-x"></i></a>
                <a href="https://www.instagram.com/unidades_uts" class="social-link" title="Instagram"><i class="bi bi-instagram"></i></a>
                <a href="https://www.youtube.com/@unidades_uts/" class="social-link" title="YouTube"><i class="bi bi-youtube"></i></a>
                <a href="https://t.me/ingsistemasuts" class="social-link" title="Telegram"><i class="bi bi-telegram"></i></a>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} Unidades Tecnológicas de Santander - Todos los derechos reservados</p>
            <p class="footer-tagline">¡Lo hacemos posible!</p>
        </div>
    </footer>

    <script>
        const WEBHOOK_URL = "{{ config('chatbot.webhook_url', 'https://n8n.srv1314294.hstgr.cloud/webhook/2b915700-f67d-45e1-80a2-bc1f737dcdf8') }}";
        
        let messageHistory = [];
        let currentCategory = null;

        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById("welcomeTime").textContent = getCurrentTime();

            const textarea = document.getElementById("chatInput");
            if (textarea) {
                textarea.addEventListener("input", function () {
                    this.style.height = "auto";
                    this.style.height = Math.min(this.scrollHeight, 120) + "px";
                });
            }
        });

        function selectCategory(category) {
            addUserMessage(category);
            currentCategory = category;

            hideQuickSuggestions();
            showTypingIndicator();

            setTimeout(() => {
                hideTypingIndicator();
                addBotMessage(
                    `Perfecto, has seleccionado la categoría: <strong>${currentCategory}</strong><br><br>Ahora sí, ¿cuál es tu pregunta específica sobre este tema?`,
                );
                enableInput();
            }, 800);
        }

        function sendMessage() {
            const input = document.getElementById("chatInput");
            const message = input.value.trim();

            if (message === "") return;

            if (!currentCategory) {
                addBotMessage(
                    "Por favor, primero selecciona una categoría de las opciones disponibles.",
                );
                return;
            }

            addUserMessage(message);
            input.value = "";
            input.style.height = "auto";
            disableInput();
            showTypingIndicator();
            sendToN8N(message);
        }

        async function sendToN8N(userQuestion) {
            try {
                const response = await fetch(WEBHOOK_URL, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify({
                        category: currentCategory,
                        question: userQuestion,
                        conversationHistory: messageHistory.slice(-10).map((msg) => ({
                            role: msg.role,
                            content: msg.content,
                        })),
                        timestamp: new Date().toISOString(),
                        sessionId: getSessionId(),
                    }),
                });

                if (!response.ok) {
                    throw new Error(`HTTP error status: ${response.status}`);
                }

                const data = await response.json();

                if (!data || typeof data !== "object") {
                    throw new Error("Respuesta inválida del servidor");
                }

                setTimeout(() => {
                    hideTypingIndicator();
                    const botResponse =
                        data.response || "Lo siento, no pude procesar tu mensaje.";
                    addBotMessage(botResponse);

                    setTimeout(() => {
                        addBotMessage(
                            `¿Tienes alguna otra pregunta sobre <strong>${currentCategory}</strong>? También puedes <a href="#" onclick="resetCategory(); return false;">cambiar de categoría</a>.`,
                        );
                        enableInput();
                    }, 1000);
                }, 800);
            } catch (error) {
                hideTypingIndicator();

                let errorMessage = "Lo siento, ";
                if (!navigator.onLine) {
                    errorMessage += "Parece que no tienes conexión a Internet.";
                } else if (error.message.includes("status: 500")) {
                    errorMessage +=
                        "Hay un problema en el servidor.";
                } else {
                    errorMessage += "Hay un problema temporal. Por favor, intenta de nuevo mas tarde.";
                }

                addBotMessage(errorMessage);
                enableInput();
            }
        }

        function resetCategory() {
            currentCategory = null;
            disableInput();
            addBotMessage("Perfecto, selecciona una nueva categoría:");
            showCategorySuggestions();
        }

        function addUserMessage(text) {
            const chatBody = document.getElementById("chatBody");
            const time = getCurrentTime();

            const messageHTML = `
                <div class="chat-message user-message">
                    <div class="message-avatar">
                        <i class="bi bi-person-fill"></i>
                    </div>
                    <div class="message-content">
                        <div class="message-bubble">
                            <p>${escapeHtml(text)}</p>
                        </div>
                        <span class="message-time">${time}</span>
                    </div>
                </div>
            `;

            chatBody.insertAdjacentHTML("beforeend", messageHTML);
            scrollToBottom();

            messageHistory.push({
                role: "user",
                content: text,
                timestamp: new Date().toISOString(),
            });
        }

        function addBotMessage(text) {
            const chatBody = document.getElementById("chatBody");
            const time = getCurrentTime();

            const messageHTML = `
                <div class="chat-message bot-message">
                    <div class="message-avatar">
                        <i class="bi bi-robot"></i>
                    </div>
                    <div class="message-content">
                        <div class="message-bubble">
                            ${formatBotMessage(text)}
                        </div>
                        <span class="message-time">${time}</span>
                    </div>
                </div>
            `;

            chatBody.insertAdjacentHTML("beforeend", messageHTML);
            scrollToBottom();

            messageHistory.push({
                role: "bot",
                content: text,
                timestamp: new Date().toISOString(),
            });
        }

        function clearChat() {
            const chatBody = document.getElementById("chatBody");
            const time = getCurrentTime();

            currentCategory = null;
            messageHistory = [];

            chatBody.innerHTML = `
                <div class="chat-message bot-message">
                    <div class="message-avatar">
                        <i class="bi bi-robot"></i>
                    </div>
                    <div class="message-content">
                        <div class="message-bubble">
                            <p>¡Hola! 👋 Soy el asistente virtual de la Facultad de Ingeniería de Sistemas.</p>
                            <p>Para ayudarte mejor, <strong>primero selecciona una categoría</strong> de las opciones a continuación:</p>
                        </div>
                        <span class="message-time">${time}</span>
                    </div>
                </div>
            `;

            showCategorySuggestions();
            disableInput();
            chatBody.scrollTop = 0;
        }

        function showCategorySuggestions() {
            const chatBody = document.getElementById("chatBody");
            const suggestionsHTML = `
                <div class="quick-suggestions" id="quickSuggestions">
                    <div class="suggestions-label">Selecciona una categoría:</div>
                    <button class="suggestion-chip" onclick="selectCategory('Modalidades de trabajos de grado')">
                        <i class="bi bi-mortarboard-fill"></i> Modalidades de trabajos de grado
                    </button>
                    <button class="suggestion-chip" onclick="selectCategory('Registro Saber TyT / Saber Pro')">
                        <i class="bi bi-person-plus-fill"></i> Registro Saber TyT / Saber Pro
                    </button>
                    <button class="suggestion-chip" onclick="selectCategory('TyT PRO/SABER PRO/ICFES')">
                        <i class="bi bi-clipboard-check"></i> TyT PRO/ SABER PRO / ICFES
                    </button>
                    <button class="suggestion-chip" onclick="selectCategory('Incapacidades médicas')">
                        <i class="bi bi-clipboard2-pulse-fill"></i> Incapacidades médicas
                    </button>
                    <button class="suggestion-chip" onclick="selectCategory('Matrícula / Liquidación')">
                        <i class="bi bi-cash-coin"></i> Matrícula / Liquidación
                    </button>
                    <button class="suggestion-chip" onclick="selectCategory('Usuarios / Contraseñas / Correo institucional')">
                        <i class="bi bi-key-fill"></i> Usuarios / Contraseñas / Correo institucional
                    </button>
                    <button class="suggestion-chip" onclick="selectCategory('Cambio de jornada')">
                        <i class="bi bi-calendar-week"></i> Cambio de jornada
                    </button>
                    <button class="suggestion-chip" onclick="selectCategory('Cambios de grupo / Horarios')">
                        <i class="bi bi-clock-history"></i> Cambios de grupo / Horarios
                    </button>
                    <button class="suggestion-chip" onclick="selectCategory('Descuentos / Única materia')">
                        <i class="bi bi-percent"></i> Descuentos / Única materia
                    </button>
                    <button class="suggestion-chip" onclick="selectCategory('Inscripciones al programa')">
                        <i class="bi bi-pencil-square"></i> Inscripciones al programa
                    </button>
                    <button class="suggestion-chip" onclick="selectCategory('Documentos de grado')">
                        <i class="bi bi-file-earmark-text"></i> Documentos de grado
                    </button>
                    <button class="suggestion-chip" onclick="selectCategory('Readmisión / Reingreso')">
                        <i class="bi bi-arrow-clockwise"></i> Readmisión / Reingreso
                    </button>
                    <button class="suggestion-chip" onclick="selectCategory('Créditos académicos')">
                        <i class="bi bi-journal-bookmark"></i> Créditos académicos
                    </button>
                    <button class="suggestion-chip" onclick="selectCategory('Cancelación de semestre')">
                        <i class="bi bi-x-circle"></i> Cancelación de semestre
                    </button>
                </div>
            `;

            chatBody.insertAdjacentHTML("beforeend", suggestionsHTML);
            scrollToBottom();
        }

        function enableInput() {
            const input = document.getElementById("chatInput");
            const btn = document.getElementById("sendBtn");
            input.disabled = false;
            btn.disabled = false;
            input.placeholder = "Escribe tu pregunta aquí...";
            input.focus();
        }

        function disableInput() {
            const input = document.getElementById("chatInput");
            const btn = document.getElementById("sendBtn");
            input.disabled = true;
            btn.disabled = true;
            input.placeholder = "Primero selecciona una categoría arriba...";
        }

        function getCurrentTime() {
            const now = new Date();
            return now.toLocaleTimeString("es-CO", {
                hour: "2-digit",
                minute: "2-digit",
            });
        }

        function escapeHtml(text) {
            const div = document.createElement("div");
            div.textContent = text;
            return div.innerHTML;
        }

        function formatBotMessage(text) {
          text = text.replace(
            /\[IMG\]https?:\/\/drive\.google\.com\/uc\?export=view&id=([a-zA-Z0-9_-]+)\[\/IMG\]/g,
            '||IMG||$1||/IMG||'
          );
          text = text.replace(/\n/g, "<br>");
          text = text.replace(
            /(https?:\/\/(?!drive\.google)[^\s<\)]+)/g,
            '<a href="$1" target="_blank">$1</a>'
          );
          text = text.replace(
            /\|\|IMG\|\|([a-zA-Z0-9_-]+)\|\|\/IMG\|\|/g,
            '<br><img src="https://lh3.googleusercontent.com/d/$1" alt="Paso" style="max-width:100%; border-radius:8px; margin:8px 0;" onerror="this.style.display=\'none\'"><br>'
          );
        
          if (!text.includes("<br>") && !text.includes("<p>")) {
            text = `<p>${text}</p>`;
          }
        
          return text;
        }

        function scrollToBottom() {
            const chatBody = document.getElementById("chatBody");
            chatBody.scrollTop = chatBody.scrollHeight;
        }

        function hideQuickSuggestions() {
            const suggestions = document.getElementById("quickSuggestions");
            if (suggestions) {
                suggestions.style.display = "none";
            }
        }

        function showTypingIndicator() {
            const indicator = document.getElementById("typingIndicator");
            if (indicator) {
                indicator.style.display = "flex";
            }
        }

        function hideTypingIndicator() {
            const indicator = document.getElementById("typingIndicator");
            if (indicator) {
                indicator.style.display = "none";
            }
        }

        function handleKeyPress(event) {
            if (event.key === "Enter" && !event.shiftKey) {
                event.preventDefault();
                sendMessage();
            }
        }

        function getSessionId() {
            let sessionId = sessionStorage.getItem("chatbot_session_id");
            if (!sessionId) {
                sessionId =
                    "session_" + Date.now() + "_" + Math.random().toString(36).substr(2, 9);
                sessionStorage.setItem("chatbot_session_id", sessionId);
            }
            return sessionId;
        }
    </script>
</body>

</html>
