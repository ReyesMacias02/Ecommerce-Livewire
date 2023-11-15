<x-app-layout>

  

    <!-- Contenedor del chatbot flotante -->
    <div id="chatbot-container">
        <h3 class="text-lg font-semibold text-gray-700 mb-2">Chatbot</h3>
        <div id="chat-messages" style="max-height: 200px; overflow-y: auto;"></div>
        <input type="text" id="user-message" class="w-full border rounded-lg p-2 mt-2" placeholder="Escribe un mensaje...">
        <button id="send-message">Enviar</button>
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
    <script src="https://cdn.botman.io/botman/web/botman.js"></script>
        <script>


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
                

            

            Livewire.on('glider', function(id){

                new Glider(document.querySelector('.glider-' + id), {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    draggable: true,
                    dots: '.glider-' + id + '~ .dots',
                    arrows: {
                        prev: '.glider-' + id + '~ .glider-prev',
                        next: '.glider-' + id + '~ .glider-next'
                    },
                    responsive: [
                        {
                            breakpoint: 640,
                            settings: {
                                slidesToShow: 2.5,
                                slidesToScroll: 2,
                            }
                        },
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 3.5,
                                slidesToScroll: 3,
                            }
                        },

                        {
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: 4.5,
                                slidesToScroll: 4,
                            }
                        },

                        {
                            breakpoint: 1280,
                            settings: {
                                slidesToShow: 5.5,
                                slidesToScroll: 5,
                            }
                        },
                    ]
                });

            });


              // Función para agregar un mensaje al chat
              function addMessage(sender, message) {
                var chatMessages = document.getElementById('chat-messages');
                var messageDiv = document.createElement('div');
                messageDiv.innerHTML = '<strong>' + sender + ':</strong> ' + message;
                chatMessages.appendChild(messageDiv);
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }


        </script>
    @endpush
    
</x-app-layout>
