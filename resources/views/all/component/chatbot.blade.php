<!-- Chatbot Modal -->
<div id="chat-modal" class="fixed bottom-20 right-5 w-96 bg-white rounded-2xl shadow-2xl border border-gray-200 hidden z-50 transform transition-all duration-300 scale-95 opacity-0">
    <!-- Header -->
    <div class="bg-blue1 text-white flex justify-between items-center px-6 py-4 rounded-t-2xl">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center backdrop-blur-sm">
                <i class="fas fa-robot text-white text-lg"></i>
            </div>
            <div>
                <h2 class="text-lg font-bold">Smart Assistant</h2>
                <div class="flex items-center space-x-1">
                    <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                    <span class="text-xs text-blue-100">Online</span>
                </div>
            </div>
        </div>
        <button id="close-modal" class="hover:bg-white/20 rounded-full p-2 transition-colors duration-200">
            <i class="fas fa-times text-white"></i>
        </button>
    </div>
    
    <!-- Chat Messages -->
    <div id="chatbox" class="p-4 space-y-3 h-80 overflow-y-auto bg-gradient-to-b from-gray-50 to-white scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100">
        <!-- Welcome Message -->
        <div class="flex justify-start animate-fadeInUp">
            <div class="flex items-start space-x-2 max-w-[85%]">
                <div class="w-8 h-8 bg-gradient-to-br from-[#283F50] to-indigo-600 rounded-full flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-robot text-white text-xs"></i>
                </div>
                <div class="bg-white rounded-2xl rounded-tl-lg px-4 py-3 shadow-md border border-gray-100">
                    <p class="text-gray-800 text-sm">👋 Halo! Saya Smart Assistant. Ada yang bisa saya bantu terkait mitigasi bencana?</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Input Section -->
    <div class="p-4 border-t border-gray-200 bg-white rounded-b-2xl">
        <!-- Quick Actions -->
        <div class="flex space-x-2 mb-3 overflow-x-auto scrollbar-hide">
            <button class="quick-action bg-blue-50 hover:bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs whitespace-nowrap transition-colors duration-200" onclick="setQuickMessage('Bagaimana cara melaporkan bencana?')">
                <i class="fas fa-exclamation-triangle mr-1"></i>
                Lapor Bencana
            </button>
            <button class="quick-action bg-green-50 hover:bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs whitespace-nowrap transition-colors duration-200" onclick="setQuickMessage('Bagaimana cara berdonasi?')">
                <i class="fas fa-heart mr-1"></i>
                Cara Donasi
            </button>
            <button class="quick-action bg-purple-50 hover:bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-xs whitespace-nowrap transition-colors duration-200" onclick="setQuickMessage('Apa itu prediksi bencana?')">
                <i class="fas fa-brain mr-1"></i>
                Prediksi
            </button>
        </div>
        
        <!-- Input Form -->
        <div class="flex space-x-2">
            <input type="text" id="user-input" class="flex-1 border border-gray-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#283F50] focus:border-transparent placeholder-gray-500 transition-all duration-200" placeholder="Ketik pertanyaan Anda...">
            <button id="send-button" class="bg-gradient-to-r from-[#283F50] to-indigo-600 hover:from-[#1f323f] hover:to-indigo-700 text-white p-3 rounded-xl transition-all duration-200 transform hover:scale-105">
                <i class="fas fa-paper-plane"></i>
            </button>
        </div>
    </div>
</div>

<style>
/* Custom scrollbar - scoped to chatbot */
#chat-modal .scrollbar-thin::-webkit-scrollbar {
    width: 4px;
}

#chat-modal .scrollbar-thin::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

#chat-modal .scrollbar-thin::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 10px;
}

#chat-modal .scrollbar-thin::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8;
}

#chat-modal .scrollbar-hide::-webkit-scrollbar {
    display: none;
}

/* Animation for messages - scoped to chatbot */
@keyframes chatFadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

#chat-modal .animate-fadeInUp {
    animation: chatFadeInUp 0.3s ease-out;
}

/* Modal animations - scoped to chatbot */
#chat-modal.chat-modal-show {
    opacity: 1 !important;
    transform: scale(1) !important;
}

/* Prevent interference with other page animations */
#chat-modal * {
    animation-fill-mode: both;
}

/* Override any global animation resets within chatbot */
#chat-modal .animate-fadeInUp {
    animation: chatFadeInUp 0.3s ease-out !important;
    opacity: 1 !important;
    transform: translateY(0) !important;
}
</style>

<script>
    // Function to toggle the modal visibility
    const chatModal = document.getElementById('chat-modal');
    const chatIcon = document.getElementById('chat-icon');
    const closeModal = document.getElementById('close-modal');

    chatIcon.onclick = function() {
        chatModal.classList.remove('hidden');
        setTimeout(() => {
            chatModal.classList.add('chat-modal-show');
        }, 10);
    }

    closeModal.onclick = function() {
        chatModal.classList.remove('chat-modal-show');
        setTimeout(() => {
            chatModal.classList.add('hidden');
            document.getElementById('chatbox').innerHTML = `
                <div class="flex justify-start animate-fadeInUp">
                    <div class="flex items-start space-x-2 max-w-[85%]">
                        <div class="w-8 h-8 bg-gradient-to-br from-[#283F50] to-indigo-600 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-robot text-white text-xs"></i>
                        </div>
                        <div class="bg-white rounded-2xl rounded-tl-lg px-4 py-3 shadow-md border border-gray-100">
                            <p class="text-gray-800 text-sm">👋 Halo! Saya Smart Assistant. Ada yang bisa saya bantu terkait mitigasi bencana?</p>
                        </div>
                    </div>
                </div>
            `;
        }, 300);
    }

    // Quick action function
    function setQuickMessage(message) {
        document.getElementById('user-input').value = message;
        sendMessage();
    }

    // Chat functionality
    function sendMessage() {
        var userInput = document.getElementById('user-input').value;
        if (userInput.trim() !== "") {
            var chatbox = document.getElementById('chatbox');

            // User message (kanan) with modern styling
            var userMessage = document.createElement('div');
            userMessage.className = 'mb-2 flex justify-end animate-fadeInUp';
            userMessage.innerHTML = `
                <div class="flex items-end space-x-2 max-w-[75%]">
                    <div class="bg-gradient-to-r from-[#283F50] to-indigo-600 text-white rounded-2xl rounded-br-lg px-4 py-2 shadow-md">
                        <p class="text-sm">${userInput}</p>
                    </div>
                    <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-user text-gray-600 text-xs"></i>
                    </div>
                </div>`;
            chatbox.appendChild(userMessage);
            chatbox.scrollTop = chatbox.scrollHeight;

            // Kirim ke API
            fetch('http://127.0.0.1:8000/api/chatbot', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    message: userInput
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network error');
                }
                return response.json();
            })
            .then(data => {
                // Bot message (kiri) with modern styling
                var botMessage = document.createElement('div');
                botMessage.className = 'mb-2 flex justify-start animate-fadeInUp';
                botMessage.innerHTML = `
                    <div class="flex items-start space-x-2 max-w-[75%]">
                        <div class="w-8 h-8 bg-gradient-to-br from-[#283F50] to-indigo-600 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-robot text-white text-xs"></i>
                        </div>
                        <div class="bg-white rounded-2xl rounded-tl-lg px-4 py-2 shadow-md border border-gray-100">
                            <p class="text-gray-800 text-sm">${data.response}</p>
                        </div>
                    </div>`;
                chatbox.appendChild(botMessage);
                chatbox.scrollTop = chatbox.scrollHeight;
            })
            .catch(error => {
                console.error('Error:', error);
                var errorMessage = document.createElement('div');
                errorMessage.className = 'mb-2 flex justify-start animate-fadeInUp';
                errorMessage.innerHTML = `
                    <div class="flex items-start space-x-2 max-w-[75%]">
                        <div class="w-8 h-8 bg-red-500 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-exclamation-triangle text-white text-xs"></i>
                        </div>
                        <div class="bg-red-50 border border-red-200 rounded-2xl rounded-tl-lg px-4 py-2">
                            <p class="text-red-700 text-sm">Gagal mengirim pesan.</p>
                        </div>
                    </div>`;
                chatbox.appendChild(errorMessage);
                chatbox.scrollTop = chatbox.scrollHeight;
            });

            // Kosongkan input
            document.getElementById('user-input').value = "";
        }
    }


    document.getElementById('send-button').addEventListener('click', sendMessage);

    // Handle enter key for input
    document.getElementById('user-input').addEventListener('keypress', function(event) {
        if (event.key === 'Enter') {
            sendMessage();
            event.preventDefault(); // Prevent form submit if in form
        }
    });
</script>