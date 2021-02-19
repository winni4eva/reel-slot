<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Counter extends Component
{
    public $count = 1;

    public function increment()
    {
      logger('Increment ++');
        $this->count++;
    }

    public function render()
    {
        return view('livewire.counter');
    }
}
