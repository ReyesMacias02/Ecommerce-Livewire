    <!-- Contenedor del chatbot flotante -->
    <div id="chatbot-container">
        <h3 class="text-lg font-semibold text-gray-700 mb-2">Chatbot</h3>
        <div id="chat-messages" style="max-height: 200px; overflow-y: auto;"></div>
        <input type="text" id="user-message" class="w-full border rounded-lg p-2 mt-2" placeholder="Escribe un mensaje...">
       
       
       
        <button wire:click="chatbot">Enviar</button>
    </div>