<?php

namespace App\View\Components\Frontend;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AboutSection extends Component
{
    /**
     * Create a new component instance.
     */
    public $aboutUs;
    public function __construct($aboutUs)
    {
        $this->aboutUs = $aboutUs;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.frontend.about-section');
    }
}
