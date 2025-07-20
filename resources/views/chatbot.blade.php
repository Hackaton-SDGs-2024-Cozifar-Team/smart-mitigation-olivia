<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">

    <div class="bg-white shadow-lg rounded-lg w-96">
        <div class="p-4 border-b">
            <h2 class="text-xl font-semibold">Chatbot</h2>
        </div>
        </div>
        <div class="p-4 border-t">
            <input type="text" id="user-input" class="border w-full p-2 rounded-lg"
                placeholder="Type a message..." />
            <button class="bg-blue-500 text-white p-2 rounded-lg mt-2 w-full" id="send-button">Send</button>
        </div>
    </div>

    <script>
        function sendMessage() {
            var userInput = document.getElementById('user-input').value;
            if (userInput.trim() !== "") {
                var chatbox = document.getElementById('chatbox');

                // Tampilkan pesan pengguna di chatbox
                var userMessage = document.createElement('div');
                userMessage.className = 'mb-4';
                userMessage.innerHTML =
                    `<div class="bg-gray-300 text-gray-800 p-2 rounded-lg inline-block">${userInput}</div>`;
                chatbox.appendChild(userMessage);

                // Kirim pesan ke API
                fetch('http://127.0.0.1:8000/api/chatbot', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}' // Token CSRF jika diperlukan
                        },
                        body: JSON.stringify({
                            message: userInput
                        })
                    })
                    .then(response => {
                        // Cek apakah respons berhasil
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        // Tampilkan respons dari API
                        var botMessage = document.createElement('div');
                        botMessage.className = 'mb-4';
                        botMessage.innerHTML =
                            `<div class="bg-blue-500 text-white p-2 rounded-lg inline-block">${data.response}</div>`;
                        chatbox.appendChild(botMessage);
                        chatbox.scrollTop = chatbox.scrollHeight; // Scroll to bottom
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        // Menampilkan pesan error di chatbox
                        var errorMessage = document.createElement('div');
                        errorMessage.className = 'mb-4';
                        errorMessage.innerHTML =
                            `<div class="bg-red-500 text-white p-2 rounded-lg inline-block">Terjadi kesalahan saat mengirim pesan.</div>`;
                        chatbox.appendChild(errorMessage);
                    });

                // Kosongkan input box
                document.getElementById('user-input').value = "";
            }
        }

        document.getElementById('send-button').addEventListener('click', sendMessage);

        // Menangani event keypress untuk input
        document.getElementById('user-input').addEventListener('keypress', function(event) {
            if (event.key === 'Enter') {
                sendMessage();
                event.preventDefault(); // Mencegah form submit jika dalam form
            }
        });
    </script>

</body>

</html>
