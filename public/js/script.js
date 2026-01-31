// Configuración del webhook de n8n
const WEBHOOK_URL = 'TU_WEBHOOK_N8N_AQUI'; // Reemplazar con la URL real del webhook
let messageHistory = [];

// Inicialización cuando carga la página
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('welcomeTime').textContent = getCurrentTime();
});

// Enviar mensaje desde el input
function sendMessage() {
    const input = document.getElementById('chatInput');
    const message = input.value.trim();
    
    if (message === '') return;
    
    addUserMessage(message);
    input.value = '';
    input.style.height = 'auto';
    hideQuickSuggestions();
    showTypingIndicator();
    sendToN8N(message);
}

// Enviar mensaje desde un botón de sugerencia
function sendQuickMessage(message) {
    hideQuickSuggestions();
    addUserMessage(message);
    showTypingIndicator();
    sendToN8N(message);
}

// Agregar mensaje del usuario al chat
function addUserMessage(text) {
    const chatBody = document.getElementById('chatBody');
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
    
    chatBody.insertAdjacentHTML('beforeend', messageHTML);
    scrollToBottom();
    
    messageHistory.push({
        role: 'user',
        content: text,
        timestamp: new Date().toISOString()
    });
}

// Agregar mensaje del bot al chat
function addBotMessage(text) {
    const chatBody = document.getElementById('chatBody');
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
    
    chatBody.insertAdjacentHTML('beforeend', messageHTML);
    scrollToBottom();
    
    messageHistory.push({
        role: 'bot',
        content: text,
        timestamp: new Date().toISOString()
    });
}

// Limpiar y reiniciar la conversación
function clearChat() {
    const chatBody = document.getElementById('chatBody');
    const time = getCurrentTime();
    
    chatBody.innerHTML = `
        <div class="chat-message bot-message">
            <div class="message-avatar">
                <i class="bi bi-robot"></i>
            </div>
            <div class="message-content">
                <div class="message-bubble">
                    <p>¡Hola! 👋 Soy el asistente virtual de la Facultad de Ingeniería de Sistemas.</p>
                    <p>Puedo ayudarte con información sobre trámites académicos, inscripciones, modalidades de grado y más. ¿En qué puedo ayudarte hoy?</p>
                </div>
                <span class="message-time">${time}</span>
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
    `;
    
    messageHistory = [];
    chatBody.scrollTop = 0;
}

// Comunicación con n8n
async function sendToN8N(message) {
    try {
        const response = await fetch(WEBHOOK_URL, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                message: message,
                history: messageHistory.slice(-10), // Enviar últimos 10 mensajes para contexto
                timestamp: new Date().toISOString(),
                sessionId: getSessionId() // ID de sesión para mantener contexto
            })
        });
        
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        
        const data = await response.json();
        
        // Simular delay de escritura natural
        setTimeout(() => {
            hideTypingIndicator();
            // Intentar obtener la respuesta de diferentes campos posibles
            const botResponse = data.response || data.output || data.message || data.text;
            
            if (botResponse) {
                addBotMessage(botResponse);
            } else {
                addBotMessage('Lo siento, no pude procesar tu mensaje. Por favor, intenta de nuevo.');
            }
        }, 800);
        
    } catch (error) {
        console.error('Error al conectar con n8n:', error);
        hideTypingIndicator();
        addBotMessage('Lo siento, hay un problema con la conexión. Por favor, intenta de nuevo en unos momentos.');
    }
}

// Utilidades
function getCurrentTime() {
    const now = new Date();
    return now.toLocaleTimeString('es-CO', { hour: '2-digit', minute: '2-digit' });
}

function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

function formatBotMessage(text) {
    // Convertir saltos de línea a <br>
    text = text.replace(/\n/g, '<br>');
    
    // Convertir URLs a enlaces
    text = text.replace(/(https?:\/\/[^\s]+)/g, '<a href="$1" target="_blank">$1</a>');
    
    // Envolver en párrafos si no hay HTML
    if (!text.includes('<br>') && !text.includes('<p>')) {
        text = `<p>${text}</p>`;
    }
    
    return text;
}

function scrollToBottom() {
    const chatBody = document.getElementById('chatBody');
    chatBody.scrollTop = chatBody.scrollHeight;
}

function hideQuickSuggestions() {
    const suggestions = document.getElementById('quickSuggestions');
    if (suggestions) {
        suggestions.style.display = 'none';
    }
}

function showTypingIndicator() {
    const indicator = document.getElementById('typingIndicator');
    if (indicator) {
        indicator.style.display = 'flex';
    }
}

function hideTypingIndicator() {
    const indicator = document.getElementById('typingIndicator');
    if (indicator) {
        indicator.style.display = 'none';
    }
}

function handleKeyPress(event) {
    // Enviar con Enter, nueva línea con Shift+Enter
    if (event.key === 'Enter' && !event.shiftKey) {
        event.preventDefault();
        sendMessage();
    }
}

function getSessionId() {
    // Obtener o crear ID de sesión único
    let sessionId = sessionStorage.getItem('chatbot_session_id');
    if (!sessionId) {
        sessionId = 'session_' + Date.now() + '_' + Math.random().toString(36).substr(2, 9);
        sessionStorage.setItem('chatbot_session_id', sessionId);
    }
    return sessionId;
}

// Auto-ajustar altura del textarea
document.addEventListener('DOMContentLoaded', function() {
    const textarea = document.getElementById('chatInput');
    if (textarea) {
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = Math.min(this.scrollHeight, 120) + 'px';
        });
    }
});