<?php

namespace App\Livewire;

use Livewire\Component;

use function Laravel\Prompts\search;

class SeacrhBox extends Component
{
    public $search = '';

    // public function updatedSearch()
    // {
    //     $this->dispatch('search', search: $this->search);
    // }

    public function update()
    {
        $this->dispatch('search', search: $this->search);
    }

    public function render()
    {
        return view('livewire.seacrh-box');
    }
}
