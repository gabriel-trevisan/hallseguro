<?php

namespace App\View\Components;

use Illuminate\View\Component;

class InputPassword extends Component
{
    /**
     * required do component
     * 
     * @var string
     */
    public $required;

    /**
     * classe do component
     * 
     * @var string
     */
    public $class;
        
    /**
     * Atributo pattern para regular expression
     *
     * @var mixed
     */
    public $pattern;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($class = "", $pattern = "", $required = "")
    {
        $this->class = $class;
        $this->pattern = $pattern;
        $this->required = $required;
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input-password');
    }
}
