<x-app-layout>
    <!-- Contenedor del chatbot con diseño básico -->
    <div id="chatbot-container" class="fixed top-0 right-0 mr-4 mt-4 bg-white rounded-lg shadow-lg p-4" style="width: 300px;">
        <h3 class="text-lg font-semibold text-gray-700 mb-2">Chatbot</h3>
        <div id="chat-messages" style="max-height: 200px; overflow-y: auto;"></div>
        <input type="text" id="user-message" class="w-full border rounded-lg p-2 mt-2" placeholder="Escribe un mensaje...">
        <button id="send-message" class="bg-blue-500 text-white rounded-lg px-4 py-2 mt-2">Enviar</button>
    </div>

    <div class="container py-8">
        @foreach ($categories as $category)
            <section class="mb-6">
                <div class="flex items-center mb-2">
                    <h1 class="text-lg uppercase font-semibold text-gray-700">
                        {{$category->name}}
                    </h1>

                    <a href="{{route('categories.show', $category)}}" class="text-orange-500 hover:text-orange-400 hover:underline ml-2 font-semibold">Ver más</a>
                </div>

                @livewire('category-products', ['category' => $category])
            </section>
        @endforeach
    </div>

    @push('script')
        <script>
            // Función para agregar un mensaje al chat
            function addMessage(sender, message) {
                var chatMessages = document.getElementById('chat-messages');
                var messageDiv = document.createElement('div');
                messageDiv.innerHTML = '<strong>' + sender + ':</strong> ' + message;
                chatMessages.appendChild(messageDiv);
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }

            // Evento de clic en el botón de enviar
            document.getElementById('send-message').addEventListener('click', function() {
                var userMessage = document.getElementById('user-message').value;
                addMessage('Tú', userMessage);
                document.getElementById('user-message').value = '';

                // Envía el mensaje al chatbot (puedes personalizar esta parte)
                // Ejemplo: botman.say(userMessage);
            });

            // Crea una nueva instancia de Botman
            var botman = new BotMan({
                drivers: ['web'],
                web: {
                    driver: 'web',
                    endpoint: '{{ route('chatbot') }}',
                },
            });

            // Escucha las respuestas del chatbot
            botman.listen(function (message) {
                addMessage('Chatbot', message.text);
            });

            // Adjunta el chatbot al elemento `#chatbot-container`
            botman.open();
        </script>
    @endpush
</x-app-layout>
