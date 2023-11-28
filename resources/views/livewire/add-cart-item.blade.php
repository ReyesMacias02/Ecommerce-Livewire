<div x-data>
    <p class="text-gray-700 mb-4">
        <span class="font-semibold text-lg">Stock disponible:</span> {{$quantity}}
    </p>

    <div class="flex">
        <div class="mr-4">
            <x-jet-secondary-button 
                disabled
                x-bind:disabled="$wire.qty <= 1"
                wire:loading.attr="disabled"
                wire:target="decrement"
                wire:click="decrement">
                -
            </x-jet-secondary-button>

            <span class="mx-2 text-gray-700">{{$qty}}</span>

            <x-jet-secondary-button 
                x-bind:disabled="$wire.qty >= $wire.quantity"
                wire:loading.attr="disabled"
                wire:target="increment"
                wire:click="increment">
                +
            </x-jet-secondary-button>
        </div>

        <div class="flex-1">
            <x-button color="orange" 
                x-bind:disabled="$wire.qty > $wire.quantity"
                class="w-full"
                wire:click="addItem"
                wire:loading.attr="disabled"
                wire:target="addItem">
                Agregar al carrito de compras
            </x-button>
        </div>
    </div>
    @push('script')
        <script>
            document.addEventListener('livewire:load', function () {
    Livewire.on('messageSent', (data) => {
        const phone = data.phone;
        const message = data.message;
        // Realizar la solicitud GET para enviar el mensaje de WhatsApp
        fetch(
        `http://localhost:8000/api/sendText?phone=${phone}&text=${encodeURIComponent(message)}&session=default`
        , {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                // Agrega cualquier otra cabecera necesaria
            },
            // Puedes agregar más opciones de configuración según tus necesidades
        })
        .then(response => response.json())
        .then(data => {
            // Manejar la respuesta si es necesario
            console.log(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
});

        </script>
    @endpush
</div>
