<?php

namespace App\Livewire\Frontend;

use App\Models\Project;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class ProjectSection extends Component
{
    public function getProjectsProperty(): Collection
    {
        return Project::query()
            ->where('status', 1)
            ->orderBy('id', 'asc')
            ->get();
    }

    public function render()
    {
        return view('livewire.frontend.project-section', [
            'projects' => $this->projects,
            'featuredProject' => $this->projects->first(),
        ]);
    }
}
