<?php

namespace App\View\Components\Frontend\Services;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ServicesCard extends Component
{
    /**
     * Create a new component instance.
     */
    public $service;
    public function __construct($service)
    {
        $this->service = $service;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.frontend.services.service-card');
    }
}
