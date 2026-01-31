 <script>
        const WEBHOOK_URL = 'TU_WEBHOOK_N8N_AQUI'; // Cambiar por tu webhook
        let messageHistory = [];
        
        // Inicializar tiempo de bienvenida
        document.getElementById('welcomeTime').textContent = getCurrentTime();
        
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
        
        function sendQuickMessage(message) {
            hideQuickSuggestions();
            addUserMessage(message);
            showTypingIndicator();
            sendToN8N(message);
        }
        
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
                            <p>Puedo ayudarte con información sobre horarios, inscripciones, plan de estudios, proyectos y más. ¿En qué puedo ayudarte hoy?</p>
                        </div>
                        <span class="message-time">${time}</span>
                    </div>
                </div>
                <div class="quick-suggestions" id="quickSuggestions">
                    <div class="suggestions-label">Preguntas frecuentes:</div>
                    <button class="suggestion-chip" onclick="sendQuickMessage('¿Cuál es el plan de estudios?')">
                        <i class="bi bi-journal-text"></i> Plan de estudios
                    </button>
                    <button class="suggestion-chip" onclick="sendQuickMessage('¿Cuáles son los horarios de atención?')">
                        <i class="bi bi-clock"></i> Horarios
                    </button>
                    <button class="suggestion-chip" onclick="sendQuickMessage('¿Cómo me inscribo a una materia?')">
                        <i class="bi bi-pencil-square"></i> Inscripciones
                    </button>
                    <button class="suggestion-chip" onclick="sendQuickMessage('Información sobre proyectos de grado')">
                        <i class="bi bi-mortarboard"></i> Proyectos
                    </button>
                    <button class="suggestion-chip" onclick="sendQuickMessage('¿Quiénes son los docentes?')">
                        <i class="bi bi-people"></i> Docentes
                    </button>
                    <button class="suggestion-chip" onclick="sendQuickMessage('Información sobre prácticas profesionales')">
                        <i class="bi bi-briefcase"></i> Prácticas
                    </button>
                </div>
            `;
            
            messageHistory = [];
            chatBody.scrollTop = 0;
        }
        
        // Comunicación con n8n (CON RESPUESTAS DE PRUEBA)
        async function sendToN8N(message) {
            // MODO PRUEBA - Descomenta esto para probar sin n8n
            setTimeout(() => {
                hideTypingIndicator();
                const response = getTestResponse(message);
                addBotMessage(response);
            }, 1500 + Math.random() * 1000);
            
            /* MODO PRODUCCIÓN - Comenta el código de arriba y descomenta esto cuando tengas n8n
            try {
                const response = await fetch(WEBHOOK_URL, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        message: message,
                        history: messageHistory.slice(-10),
                        timestamp: new Date().toISOString()
                    })
                });
                
                if (!response.ok) throw new Error('Error en la respuesta');
                
                const data = await response.json();
                
                setTimeout(() => {
                    hideTypingIndicator();
                    const botResponse = data.response || data.output || data.message;
                    addBotMessage(botResponse || 'Lo siento, no pude procesar tu mensaje.');
                }, 1000);
                
            } catch (error) {
                console.error('Error:', error);
                hideTypingIndicator();
                addBotMessage('Lo siento, hay un problema con la conexión. Por favor, intenta de nuevo.');
            }
            */
        }
        
        // Respuestas de prueba
        function getTestResponse(message) {
            const msgLower = message.toLowerCase();
            
            if (msgLower.includes('plan de estudios') || msgLower.includes('pensum')) {
                return `El plan de estudios de Ingeniería de Sistemas incluye 10 semestres académicos con las siguientes áreas principales:

• Programación y Desarrollo de Software
• Bases de Datos y Sistemas de Información
• Redes y Comunicaciones
• Arquitectura de Computadores
• Gestión de Proyectos
• Inteligencia Artificial y Machine Learning

¿Te gustaría información más detallada sobre algún semestre en particular?`;
            } 
            else if (msgLower.includes('horarios') || msgLower.includes('horario')) {
                return `Los horarios de atención de la Facultad de Ingeniería de Sistemas son:

📅 Lunes a Viernes: 7:00 AM - 7:00 PM
📅 Sábados: 8:00 AM - 2:00 PM

Para atención específica:
• Secretaría: 8:00 AM - 12:00 PM y 2:00 PM - 5:00 PM
• Coordinación: Previa cita

¿Necesitas información sobre algún servicio específico?`;
            }
            else if (msgLower.includes('inscri') || msgLower.includes('materia')) {
                return `Para inscribirte a materias debes seguir estos pasos:

1. Ingresa al portal académico con tu usuario y contraseña
2. Ve a la sección "Inscripciones"
3. Verifica los prerrequisitos de las materias
4. Selecciona las materias disponibles según tu horario
5. Confirma tu inscripción antes de la fecha límite

📌 Recuerda: El periodo de inscripciones es del 15 al 25 de cada mes.

¿Tienes alguna duda específica sobre el proceso 
</script>