<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class WhatsAppComponent extends Component
{
    public function conect()
    {
        
        $this->startSession();
    }
    public function startSession()
    {
        $url = "http://localhost:8000/api/sessions/start"; // Ajusta la URL según tu entorno local

        $body = [
            "name" => "default",
            "config" => [
                "proxy" => null,
                "webhooks" => [
                    [
                        "url" => "https://httpbin.org/post",
                        "events" => [
                            "message",
                            "session.status"
                        ],
                        "hmac" => null,
                        "retries" => null,
                        "customHeaders" => null
                    ]
                ]
            ]
        ];
        $response = Http::post($url, $body);
        // Manejar la respuesta
        if ($response->successful()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Sesión iniciada con éxito.',
                'data' => $response->json()
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Error al iniciar la sesión.',
                'data' => $response->json()
            ], $response->status());
        }
        dd($response);
    }
    
    public function render()
    {
     
        return view('livewire.admin.whatsapp')->layout('layouts.admin');
    }
  
}
