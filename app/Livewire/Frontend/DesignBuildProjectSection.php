<?php

namespace App\Livewire\Frontend;

use App\Models\PageDesign;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class DesignBuildProjectSection extends Component
{
    public function getPageDesignsProperty(): Collection
    {
        return PageDesign::query()
            ->orderByDesc('id')
            ->get();
    }

    public function render()
    {
        return view('livewire.frontend.design-build-project-section', [
            'pageDesigns' => $this->pageDesigns,
            'featuredDesign' => $this->pageDesigns->first(),
        ]);
    }
}
