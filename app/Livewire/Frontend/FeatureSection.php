<?php

namespace App\Livewire\Frontend;

use App\Models\Feature;
use Livewire\Component;

class FeatureSection extends Component
{
    public function getFeatureProperty(): ?Feature
    {
        return Feature::query()->first();
    }

    public function render()
    {
        return view('livewire.frontend.feature-section', [
            'feature' => $this->feature,
        ]);
    }
}
