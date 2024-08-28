<?php

namespace App\Livewire;

use Livewire\Component;

class Statistic extends Component
{
    public $labels;
    public $data;

    public function mount($labels, $data)
    {
        $this->labels = $labels;
        $this->data = $data;
    }

    public function render()
    {
        return view('livewire.component.statistic');
    }
}
