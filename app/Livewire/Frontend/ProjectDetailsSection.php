<?php

namespace App\Livewire\Frontend;

use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class ProjectDetailsSection extends Component
{
    public Project $project;

    public function mount(Project $project): void
    {
        $this->project = $project;
    }

    public function getProjectsProperty(): Collection
    {
        return Project::query()
            ->where('status', 1)
            ->orderByDesc('id')
            ->get();
    }

    public function render()
    {
        return view('livewire.frontend.project-details-section', [
            'projects' => $this->projects,
            'galleryMedia' => ProjectImage::query()
                ->where('project_id', $this->project->id)
                ->latest('id')
                ->get(),
        ]);
    }
}
