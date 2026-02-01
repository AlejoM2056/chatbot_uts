<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asistente Virtual - Ingeniería de Sistemas UTS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ secure_asset('css/chatbot.css') }}">
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
                Bienvenido al asistente virtual de la Facultad de Ingeniería de Sistemas. 
                Estoy diseñado para ayudarte a resolver tus dudas.
            </p>
        </div>
        
        <div class="chatbot-container">
            <div class="chatbot-window">
                <!-- Header -->
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
                
                <!-- Body -->
                <div class="chatbot-body" id="chatBody">
                    <div class="chat-message bot-message">
                        <div class="message-avatar">
                            <i class="bi bi-robot"></i>
                        </div>
                        <div class="message-content">
                            <div class="message-bubble">
                                <p>¡Hola! 👋 Soy el asistente virtual de la Facultad de Ingeniería de Sistemas.</p>
                                <p>Puedo ayudarte con información sobre trámites académicos, inscripciones, modalidades de grado y más. ¿En qué puedo ayudarte hoy?</p>
                            </div>
                            <span class="message-time" id="welcomeTime"></span>
                        </div>
                    </div>
                    
                    <div class="quick-suggestions" id="quickSuggestions">
                        <div class="suggestions-label">¿En qué puedo ayudarte?</div>
                        <button class="suggestion-chip" onclick="sendQuickMessage('¿Cuáles son las modalidades de trabajos de grado?')">
                            <i class="bi bi-mortarboard-fill"></i> Modalidades de grado
                        </button>
                        <button class="suggestion-chip" onclick="sendQuickMessage('Información sobre TyT PRO / SABER PRO')">
                            <i class="bi bi-clipboard-check"></i> TyT PRO / SABER PRO
                        </button>
                        <button class="suggestion-chip" onclick="sendQuickMessage('¿Cómo realizo la matrícula y liquidación?')">
                            <i class="bi bi-cash-coin"></i> Matrícula / Liquidación
                        </button>
                        <button class="suggestion-chip" onclick="sendQuickMessage('Ayuda con usuarios y contraseñas')">
                            <i class="bi bi-key-fill"></i> Usuarios / Contraseñas
                        </button>
                        <button class="suggestion-chip" onclick="sendQuickMessage('¿Cómo solicito cambio de jornada?')">
                            <i class="bi bi-calendar-week"></i> Cambio de jornada
                        </button>
                        <button class="suggestion-chip" onclick="sendQuickMessage('Información sobre cambios de grupo y horarios')">
                            <i class="bi bi-clock-history"></i> Cambios de grupo
                        </button>
                        <button class="suggestion-chip" onclick="sendQuickMessage('¿Qué descuentos hay para única materia?')">
                            <i class="bi bi-percent"></i> Descuentos
                        </button>
                        <button class="suggestion-chip" onclick="sendQuickMessage('¿Cómo me inscribo al programa?')">
                            <i class="bi bi-pencil-square"></i> Inscripciones
                        </button>
                        <button class="suggestion-chip" onclick="sendQuickMessage('Documentos necesarios para grado')">
                            <i class="bi bi-file-earmark-text"></i> Documentos de grado
                        </button>
                        <button class="suggestion-chip" onclick="sendQuickMessage('Información sobre readmisión o reingreso')">
                            <i class="bi bi-arrow-clockwise"></i> Readmisión / Reingreso
                        </button>
                        <button class="suggestion-chip" onclick="sendQuickMessage('¿Qué son los créditos académicos?')">
                            <i class="bi bi-journal-bookmark"></i> Créditos académicos
                        </button>
                        <button class="suggestion-chip" onclick="sendQuickMessage('¿Cómo cancelo el semestre?')">
                            <i class="bi bi-x-circle"></i> Cancelación de semestre
                        </button>
                    </div>
                </div>
                
                <!-- Typing indicator -->
                <div class="typing-indicator" id="typingIndicator">
                    <div class="typing-dots">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <span>El asistente está escribiendo...</span>
                </div>
                
                <!-- Footer -->
                <div class="chatbot-footer">
                    <div class="chat-input-container">
                        <textarea 
                            class="chat-input" 
                            id="chatInput" 
                            placeholder="Escribe tu pregunta aquí..."
                            rows="1"
                            onkeypress="handleKeyPress(event)"
                        ></textarea>
                        <button class="btn-send" id="sendBtn" onclick="sendMessage()">
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
    
    <script src="{{ secure_asset('js/chatbot.js') }}"></script>

</body>
</html>