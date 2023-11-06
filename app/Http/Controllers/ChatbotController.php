<?php

namespace App\Http\Controllers;

use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;

class ChatbotController extends Controller
{
    public function handle()
    {
        $botman = app('botman');

        $botman->hears('Hola', function (BotMan $bot) {
            $bot->reply('Hola, ¿en qué puedo ayudarte?');
        });

        // Puedes agregar más escuchas y respuestas aquí

        $botman->listen();
    }
}
