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
                <a id="contain-desktop-logos" class="navbar-brand ms-5" href="/">
                    <img src="{{ asset('images/favicon.png') }}" alt="Favicon" height="50">
                    <img src="{{ asset('images/escudo-uts.png') }}" alt="UTS Logo" height="50">
                </a>
                <a id="contain-mobile-logos" class="navbar-brand" href="/">
                    <img src="{{ asset('images/programa-logo.png') }}" alt="Favicon" height="40">
                </a>
              <div class="ms-auto d-flex align-items-center gap-2">
                 <a href="https://sistemastg.uts.edu.co" target="_blank" class="btn-nav-noticias">
                    <span class="btn-nav"></span>
                    <i class="bi bi-newspaper"></i>
                    <span>Noticias del Programa</span>
                </a>
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
 
<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
<script>
    const WEBHOOK_URL = "{{ config('chatbot.webhook_url', 'https://n8n.srv1314294.hstgr.cloud/webhook/2b915700-f67d-45e1-80a2-bc1f737dcdf8') }}";
    let messageHistory     = [];
    let currentCategory    = null;
    let userInfo           = { name: null, email: null };
    let collectingUserInfo = false;

    const categories = {
        "Grado y Titulación": {
            icon: "bi-mortarboard-fill",
            subcategories: [
                { label: "Modalidades de trabajos de grado", icon: "bi-mortarboard-fill" },
                { label: "Documentos de grado",              icon: "bi-file-earmark-text" },
                { label: "Créditos académicos",              icon: "bi-journal-bookmark"  },
            ]
        },
        "Exámenes de Estado": {
            icon: "bi-clipboard-check",
            subcategories: [
                { label: "Registro Saber TyT / Saber Pro", icon: "bi-person-plus-fill" },
                { label: "TyT PRO / SABER PRO / ICFES",    icon: "bi-clipboard-check"  },
            ]
        },
        "Matrícula, Pagos y Cancelación": {
            icon: "bi-cash-coin",
            subcategories: [
                { label: "Matrícula / Liquidación",    icon: "bi-cash-coin" },
                { label: "Descuentos / Única materia", icon: "bi-percent"   },
                { label: "Cancelación de semestre",    icon: "bi-x-circle"  },
            ]
        },
        "Gestión Académica": {
            icon: "bi-calendar-week",
            subcategories: [
                { label: "Cambio de jornada",             icon: "bi-calendar-week"  },
                { label: "Cambios de grupo / Horarios",   icon: "bi-clock-history"  },
                { label: "Inscripciones al programa",     icon: "bi-pencil-square"  },
                { label: "Readmisión / Reingreso",        icon: "bi-arrow-clockwise"},
            ]
        },
        "Soporte Técnico": {
            icon: "bi-key-fill",
            direct: "Usuarios / Contraseñas / Correo institucional"
        },
        "Incapacidades Médicas": {
            icon: "bi-hospital-fill",
            direct: "Incapacidades médicas"
        },
    };

    function renderMainCategories() {
        const suggestionsDiv = document.getElementById('quickSuggestions');
        if (!suggestionsDiv) return;

        let html = `<div class="suggestions-label">Selecciona una categoría:</div>`;

        for (const [group, data] of Object.entries(categories)) {
            if (data.direct) {
                html += `<button class="suggestion-chip" data-action="direct" data-value="${data.direct}">
                    <i class="bi ${data.icon}"></i> ${group}
                </button>`;
            } else {
                html += `<button class="suggestion-chip" data-action="group" data-value="${group}">
                    <i class="bi ${data.icon}"></i> ${group}
                </button>`;
            }
        }

        suggestionsDiv.innerHTML = html;

        suggestionsDiv.querySelectorAll('[data-action="direct"]').forEach(btn => {
            btn.addEventListener('click', () => selectCategory(btn.dataset.value));
        });
        suggestionsDiv.querySelectorAll('[data-action="group"]').forEach(btn => {
            btn.addEventListener('click', () => renderSubcategories(btn.dataset.value));
        });
    }

    function renderSubcategories(group) {
        const suggestionsDiv = document.getElementById('quickSuggestions');
        if (!suggestionsDiv) return;

        const data = categories[group];
        let html = `<div class="suggestions-label">${group}:</div>`;

        for (const sub of data.subcategories) {
            html += `<button class="suggestion-chip" data-action="sub" data-value="${sub.label}">
                <i class="bi ${sub.icon}"></i> ${sub.label}
            </button>`;
        }

        html += `<button class="suggestion-chip suggestion-chip--back" data-action="back">
            <i class="bi bi-arrow-left"></i> Volver
        </button>`;

        suggestionsDiv.innerHTML = html;

        suggestionsDiv.querySelectorAll('[data-action="sub"]').forEach(btn => {
            btn.addEventListener('click', () => selectCategory(btn.dataset.value));
        });
        suggestionsDiv.querySelector('[data-action="back"]').addEventListener('click', renderMainCategories);
    }

    document.addEventListener("DOMContentLoaded", function () {
        document.getElementById("welcomeTime").textContent = getCurrentTime();

        renderMainCategories();

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

        if (userInfo.name && userInfo.email) {
            collectingUserInfo = false;
            setTimeout(() => {
                hideTypingIndicator();
                addBotMessage(
                    `Perfecto <strong>${userInfo.name}</strong>, has seleccionado: ` +
                    `<strong>${currentCategory}</strong><br>` +
                    `¿Cuál es tu pregunta sobre este tema?`
                );
                enableInput();
            }, 800);
            return;
        }

        collectingUserInfo = "name";
        setTimeout(() => {
            hideTypingIndicator();
            addBotMessage(
                `Por favor escribe tu <strong>Nombre Completo</strong>.`
            );
            enableInput();
        }, 800);
    }

    function sendMessage() {
        const input   = document.getElementById("chatInput");
        const message = input.value.trim();

        if (message === "") return;

        if (!currentCategory) {
            addBotMessage(`Por favor ${userInfo.name}, primero selecciona una categoría de las opciones disponibles.`);
            return;
        }

        if (collectingUserInfo) {
            handleUserInfoInput(message);
            input.value        = "";
            input.style.height = "auto";
            return;
        }

        addUserMessage(message);
        input.value        = "";
        input.style.height = "auto";
        disableInput();
        showTypingIndicator();
        sendToN8N(message);
    }

    function handleUserInfoInput(rawText) {
        addUserMessage(rawText);
        disableInput();
        showTypingIndicator();

        if (collectingUserInfo === "name") {
            const name = rawText.trim();

            if (!name || name.length < 2) {
                setTimeout(() => {
                    hideTypingIndicator();
                    addBotMessage("Por favor escribe tu <strong>Nombre Completo</strong>.");
                    enableInput();
                }, 600);
                return;
            }

            userInfo.name      = name;
            collectingUserInfo = "email";

            setTimeout(() => {
                hideTypingIndicator();
                addBotMessage(
                    `Mucho gusto, <strong>${name}</strong> 👋<br>` +
                    `Ahora, ¿cuál es tu <strong>Correo Institucional</strong>?`
                );
                enableInput();
            }, 700);
            return;
        }

        if (collectingUserInfo === "email") {
            const email = rawText.trim();

            if (!email || !email.includes("@")) {
                setTimeout(() => {
                    hideTypingIndicator();
                    addBotMessage(
                        `Ese correo no es válido. Por favor escribe tu correo institucional.<br>` +
                        `<em>Ejemplo: juanperez@uts.edu.co</em>`
                    );
                    enableInput();
                }, 600);
                return;
            }

            userInfo.email     = email;
            collectingUserInfo = false;

            setTimeout(() => {
                hideTypingIndicator();
                addBotMessage(
                    `Perfecto <strong>${userInfo.name}</strong> ✅<br>` +
                    `Ahora sí, ¿cuál es tu pregunta sobre <strong>${currentCategory}</strong>?`
                );
                enableInput();
            }, 700);
        }
    }

    async function sendToN8N(userQuestion) {
        try {
            const response = await fetch(WEBHOOK_URL, {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({
                    category:            currentCategory,
                    question:            userQuestion,
                    userName:            userInfo.name,
                    userEmail:           userInfo.email,
                    conversationHistory: messageHistory.slice(-10).map(msg => ({
                        role:    msg.role,
                        content: msg.content,
                    })),
                    timestamp: new Date().toISOString(),
                    sessionId: getSessionId(),
                }),
            });

            if (!response.ok) throw new Error(`HTTP error status: ${response.status}`);

            const data = await response.json();
            if (!data || typeof data !== "object") throw new Error("Respuesta inválida del servidor");

            setTimeout(() => {
                hideTypingIndicator();
                const botResponse = data.response || "Lo siento, no pude procesar tu mensaje.";
                addBotMessage(botResponse);

                setTimeout(() => {
                    addBotMessage(
                        `<strong>${userInfo.name}</strong>, ¿tienes alguna otra pregunta sobre <strong>${currentCategory}</strong>? ` +
                        `También puedes <a href="#" onclick="resetCategory(); return false;">cambiar de categoría</a>.`
                    );
                    enableInput();
                }, 1000);
            }, 800);

        } catch (error) {
            hideTypingIndicator();

            let errorMessage = "Lo siento, ";
            if (!navigator.onLine) {
                errorMessage += "sin conexión a Internet.";
            } else if (error.message.includes("status: 500")) {
                errorMessage += "hay un problema en el servidor.";
            } else {
                errorMessage += "hay un problema temporal. Por favor, intenta de nuevo más tarde.";
            }

            addBotMessage(errorMessage);
            enableInput();
        }
    }

    function resetCategory() {
        currentCategory    = null;
        collectingUserInfo = false;
        disableInput();
        addBotMessage(
            `Perfecto <strong>${userInfo.name}</strong>, selecciona una nueva categoría:`
        );
        showCategorySuggestions();
    }

    function addUserMessage(text) {
        const chatBody = document.getElementById("chatBody");
        const time     = getCurrentTime();

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
            </div>`;

        chatBody.insertAdjacentHTML("beforeend", messageHTML);
        scrollToBottom();
        messageHistory.push({ role: "user", content: text, timestamp: new Date().toISOString() });
    }

    function addBotMessage(text) {
        const chatBody = document.getElementById("chatBody");
        const time     = getCurrentTime();

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
            </div>`;

        chatBody.insertAdjacentHTML("beforeend", messageHTML);
        scrollToBottom();
        messageHistory.push({ role: "bot", content: text, timestamp: new Date().toISOString() });
    }

    function clearChat() {
        const chatBody = document.getElementById("chatBody");
        const time     = getCurrentTime();

        currentCategory    = null;
        messageHistory     = [];
        userInfo           = { name: null, email: null };
        collectingUserInfo = false;

        chatBody.innerHTML = `
            <div class="chat-message bot-message">
                <div class="message-avatar">
                    <i class="bi bi-robot"></i>
                </div>
                <div class="message-content">
                    <div class="message-bubble">
                        <p>¡Hola! 👋 Soy el asistente virtual del Programa de Ingeniería de Sistemas.</p>
                        <p>Para ayudarte mejor, <strong>primero selecciona una categoría</strong> de las opciones a continuación:</p>
                    </div>
                    <span class="message-time">${time}</span>
                </div>
            </div>`;

        showCategorySuggestions();
        disableInput();
        chatBody.scrollTop = 0;
    }

    function showCategorySuggestions() {
        const chatBody = document.getElementById("chatBody");

        document.querySelectorAll('#quickSuggestions').forEach(el => el.remove());

        chatBody.insertAdjacentHTML("beforeend", `
            <div class="quick-suggestions" id="quickSuggestions"></div>
        `);

        renderMainCategories();
        scrollToBottom();
    }

    function enableInput() {
        const input = document.getElementById("chatInput");
        const btn   = document.getElementById("sendBtn");
        input.disabled = false;
        btn.disabled   = false;

        if (collectingUserInfo === "name") {
            input.placeholder = "Escribe tu nombre completo...";
        } else if (collectingUserInfo === "email") {
            input.placeholder = "Escribe tu correo institucional...";
        } else {
            input.placeholder = "Escribe tu pregunta aquí...";
        }

        input.focus();
    }

    function disableInput() {
        const input = document.getElementById("chatInput");
        const btn   = document.getElementById("sendBtn");
        input.disabled    = true;
        btn.disabled      = true;
        input.placeholder = "Primero selecciona una categoría arriba...";
    }

    function getCurrentTime() {
        return new Date().toLocaleTimeString("es-CO", { hour: "2-digit", minute: "2-digit" });
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
        const s = document.getElementById("quickSuggestions");
        if (s) s.style.display = "none";
    }

    function showTypingIndicator() {
        const i = document.getElementById("typingIndicator");
        if (i) i.style.display = "flex";
    }

    function hideTypingIndicator() {
        const i = document.getElementById("typingIndicator");
        if (i) i.style.display = "none";
    }

    function handleKeyPress(event) {
        if (event.key === "Enter" && !event.shiftKey) {
            event.preventDefault();
            sendMessage();
        }
    }
    function getSessionId() {
        let id = sessionStorage.getItem("chatbot_session_id");
        if (!id) {
            id = "session_" + Date.now() + "_" + Math.random().toString(36).substr(2, 9);
            sessionStorage.setItem("chatbot_session_id", id);
        }
        return id;
    }
    </script>
</body>
</html>
