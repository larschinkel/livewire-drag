<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Things extends Component
{
    public $things = [
        ['id' => 1, 'title' => 'Abwaschen'],
        ['id' => 2, 'title' => 'Staubwischen'],
        ['id' => 3, 'title' => 'Wäsche zusammen legen'],
        ['id' => 4, 'title' => 'Saugen'],
        ['id' => 5, 'title' => 'Toilette putzen'],
    ];

    public function reorder($keys)
    {
        $this->things = collect($keys)->map(function ($key) {
            return collect($this->things)->where('id', (int) $key)->first();
        })->toArray();
    }

    public function render()
    {
        shuffle($this->things);
        return view('livewire.things');
    }
}
