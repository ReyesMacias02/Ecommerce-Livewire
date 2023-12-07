<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;
use PhpMqtt\Client\Facades\MQTT;
use Illuminate\Support\Facades\Log;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PaymentOrder extends Component
{

    use AuthorizesRequests;

    public $order;

    protected $listeners = ['payOrder'];

    public function mount(Order $order){
        $this->order = $order;
    }


    public function payOrder(){
        $this->order->status = 2;
        $this->order->save();
// Enviar mensaje MQTT al canal 'orders'
$topic = 'orders';
$message = json_encode(['order_id' => $this->order->id, 'status' => $this->order->status]);

try {
    MQTT::publish($topic, $message);
} catch (\Exception $exception) {
    Log::error('Error al enviar mensaje MQTT: ' . $exception->getMessage());
}
        return redirect()->route('orders.show', $this->order);
    }


    public function render()
    {

        $this->authorize('author', $this->order);
        $this->authorize('payment', $this->order);

        $items = json_decode($this->order->content);
        $envio = json_decode($this->order->envio);

        return view('livewire.payment-order', compact('items', 'envio'));
    }
}
