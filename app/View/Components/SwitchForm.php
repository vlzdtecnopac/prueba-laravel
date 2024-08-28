<?php

namespace App\View\Components;


use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SwitchForm extends Component
{

    public $id;
    public $name;
    public $value;
    public $checked;

    public function __construct($id, $name, $value = null, $checked = false)
    {
        $this->id = $id;
        $this->name = $name;
        $this->value = $value;
        $this->checked = $checked;
    }

    public function render(): View
    {
        return view('components.switch-form');
    }
}
