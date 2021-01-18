<?php

namespace App\View\Components\Ups;

use Illuminate\View\Component;

class Event extends Component
{
    public $upsEvent;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($upsEvent)
    {
        $this->upsEvent = $upsEvent;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.ups.event');
    }
}
