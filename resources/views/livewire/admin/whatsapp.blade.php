<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            WhatsApp
        </h2>
    </x-slot>

    <div class="container py-12">
     
            <h1>¡Contáctanos en WhatsApp!</h1>
            <p>Estado: <span id="whatsapp-status-badge">Disponible</span></p>
            <p>Nombre: Jose</p>
            <p>Número: Jose</p>
            <button style="  padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;" id="startSessionButton">Abrir WhatsApp</button>
            <button  style="  padding: 10px 20px;
            background-color:   #3c553d;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;" id="scanQr">Escanear QR </button>
       
    
    </div>
    @push('script')
    <script>
        document.getElementById("startSessionButton").addEventListener("click", function() {
            var myHeaders = new Headers();
            myHeaders.append("Content-Type", "application/json");
        
            var raw = JSON.stringify({
                "name": "default",
                "config": {
                    "proxy": null,
                    "webhooks": [
                        {
                            "url": "https://httpbin.org/post",
                            "events": [
                                "message",
                                "session.status"
                            ],
                            "hmac": null,
                            "retries": null,
                            "customHeaders": null
                        }
                    ]
                }
            });
        
            var requestOptions = {
                method: 'POST',
                headers: myHeaders,
                body: raw,
                redirect: 'follow'
            };
        
            fetch("https://localhost/api/sessions/start", requestOptions)
                .then(response => response.text())
                .then(result => console.log(result))
                .catch(error => console.log('error', error));
            fetch("https://localhost/api/sessions/default/me", requestOptions)
                .then(response => response.text())
                .then(result => console.log(result))
                .catch(error => console.log('error', error));
        });
        </script>

<script>
    document.getElementById("scanQr").addEventListener("click", function() {
        var myHeaders = new Headers();
        myHeaders.append("Content-Type", "application/json");
    
      
    
        var requestOptions = {
            method: 'GET',
            headers: myHeaders,
            redirect: 'follow'
        };
    
        fetch("https://localhost/api/default/auth/qr", requestOptions)
            .then(response => response.blob ())
            .then(blob => {
        // Crea un objeto URL para el blob
        const imageUrl = URL.createObjectURL(blob);

        // Crea un elemento de imagen
        const qrImage = document.createElement("img");

        // Establece el atributo 'src' con la URL del blob
        qrImage.src = imageUrl;

        // Añade la imagen al documento (por ejemplo, al body)
        document.body.appendChild(qrImage);
    })
            .catch(error => console.log('error', error));
    });
    </script>




    @endpush
</div>
