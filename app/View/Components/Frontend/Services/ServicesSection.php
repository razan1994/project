<?php

namespace App\View\Components\Frontend\Services;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ServicesSection extends Component
{
    /**
     * Create a new component instance.
     */
    public $services;
    public function __construct($services)
    {
        $this->services = $services;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.frontend.services.services-section');
    }
}
