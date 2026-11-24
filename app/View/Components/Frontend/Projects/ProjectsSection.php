<?php

namespace App\View\Components\Frontend\Projects;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProjectsSection extends Component
{
    /**
     * Create a new component instance.
     */
    public $projects;
    public function __construct($projects)
    {
        $this->projects = $projects;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.frontend.projects.projects-section');
    }
}
