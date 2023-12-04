<?php

namespace App\Http\Livewire;


use Livewire\Component;

class Chatbot extends Component
{

    public $search;

    public $open = false;
    
    function chatbot()  {
        dd("llego el emit");
    }
    public function render()
    {

      
        
        return view('livewire.chat-bot');
    }
}
