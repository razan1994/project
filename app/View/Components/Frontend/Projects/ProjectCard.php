<?php

namespace App\View\Components\Frontend\Projects;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProjectCard extends Component
{
    /**
     * Create a new component instance.
     */
    public $project;
    public function __construct($project)
    {
        $this->project = $project;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.frontend.projects.project-card');
    }
}
