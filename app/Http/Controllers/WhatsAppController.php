<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WhatsAppController extends Controller
{
    public function whatsapp()
    {
        // Define los datos que quieres mostrar en la vista
        $nombre = "Eber";
        $numero = "0999999999";

        return view('admin.whatsapp.whatsapp', compact('nombre', 'numero'));
    }
}
