<?php

namespace App\View\Components\Ups;

use Illuminate\View\Component;

class Reading extends Component
{

    public $upsReading;
    public $events;

    public function __construct($upsReading, $events)
    {
        $this->upsReading = $upsReading;
        $this->events = $events;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.ups.reading');
    }
}
