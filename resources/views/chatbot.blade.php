<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Asistente Virtual - Ingeniería de Sistemas UTS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<div class="contain-nav-hero">
         <nav class="navbar navbar-expand-lg navbar-light shadow-sm">
        <div class="container-fluid px-4">
 
            <a id="contain-desktop-logos" class="navbar-brand ms-3" href="/">
                <img src="{{ asset('images/favicon.png') }}" alt="Favicon" height="50">
                <img src="{{ asset('images/escudo-uts.png') }}" alt="UTS Logo" height="50">
            </a>
 
            <a id="contain-mobile-logos" class="navbar-brand" href="/">
                <img src="{{ asset('images/programa-logo.png') }}" alt="Favicon" height="40">
            </a>
 
            <button class="navbar-toggler border-0 ms-auto" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarButtons"
                aria-controls="navbarButtons"
                aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
 
            <div class="collapse navbar-collapse justify-content-end" id="navbarButtons">
                <div class="d-flex flex-column flex-lg-row align-items-stretch align-items-lg-center gap-2 py-3 py-lg-0">
 
                    <a href="https://sistemastg.uts.edu.co" target="_blank" class="btn btn-uts-green px-3">
                        <i class="bi bi-newspaper me-2"></i>Noticias del Programa
                    </a>
 
                    <a href="https://sistemastg.uts.edu.co/#documentos" class="btn btn-uts-gray px-3">
                        <i class="bi bi-folder2-open me-2"></i>Documentos
                    </a>
 
                </div>
            </div>
 
        </div>
    </nav>
    </div>
 

    
    <div class="container">
        <div class="info-section">
            <h2>
                <i class="bi bi-info-circle-fill"></i>
                Sobre el Asistente Virtual
            </h2>
            <p>
                ¡Bienvenido al asistente virtual del Programa de Ingeniería de Sistemas!
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
                                <p>¡Hola! 👋 Soy el asistente virtual del Programa de Ingeniería de Sistemas.</p>
                                <p>Para ayudarte mejor, <strong>primero selecciona una categoría</strong> de las
                                    opciones a continuación:</p>
                            </div>
                            <span class="message-time" id="welcomeTime"></span>
                        </div>
                    </div>
                    <div class="quick-suggestions" id="quickSuggestions"></div>
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
                    <p>Programa de Ingeniería de Sistemas</p>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
