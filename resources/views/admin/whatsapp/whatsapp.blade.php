<x-admin-layout>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 20px;
        }

        h1 {
            font-size: 24px;
        }

        .container {
            background-color: #f2f2f2;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            margin: 0 auto;
        }

        p {
            font-size: 16px;
        }

        #whatsapp-button {
            background-color: #25d366;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        #whatsapp-button:hover {
            background-color: #128c7e;
        }
    </style>
    <div>
        <div class="container">
        <h1>¡Contáctanos en WhatsApp!</h1>
        <p>Estado: <span id="whatsapp-status-badge">Disponible</span></p>
        <p>Nombre: {{ $nombre }}</p>
        <p>Número: {{ $numero }}</p>
        <button id="whatsapp-button">Abrir WhatsApp</button>
    </div>

    <script>
        document.getElementById('whatsapp-button').addEventListener('click', function() {
            // Reemplaza 'tu_numero_de_telefono' con el número de WhatsApp al que deseas enviar el mensaje.
            var phoneNumber = 'tu_numero_de_telefono';
            var message = 'Hola, ¿cómo estás?';

            var whatsappLink = 'https://api.whatsapp.com/send?phone=' + phoneNumber + '&text=' + encodeURIComponent(message);
            window.open(whatsappLink, '_blank');
        });
    </script>
    
    </div>
    

</x-admin-layout>


