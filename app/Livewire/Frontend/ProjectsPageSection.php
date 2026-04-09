<?php

namespace App\Livewire\Frontend;

use App\Models\Category;
use App\Models\Project;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class ProjectsPageSection extends Component
{

    public function getCategoriesProperty(): Collection
    {
        return Category::query()
            ->where('status', 1)
            ->whereHas('projects')
            ->with('projects')
            ->orderBy('order', 'asc')
            ->get();
    }

    public function getProjectsProperty(): Collection
    {
        return Project::query()
            ->where('status', 1)
            ->orderBy('order', 'asc')
            ->get();
    }


    public function render()
    {
        return view('livewire.frontend.projects-page-section', [
            'categories' => $this->categories,
            'projects' => $this->projects,
            'featuredProject' => $this->projects->first(),
        ]);
    }
}
