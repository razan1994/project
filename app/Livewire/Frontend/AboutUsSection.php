<?php

namespace App\Livewire\Frontend;

use App\Models\About;
use App\Models\Mission;
use App\Models\Values;
use App\Models\Vision;
use Livewire\Component;
use App\Models\Feature;

class AboutUsSection extends Component
{
    public function getAboutProperty(): ?About
    {
        return About::query()->latest('id')->first();
    }

    public function getVisionProperty(): ?Vision
    {
        return Vision::query()->latest('id')->first();
    }

    public function getMissionProperty(): ?Mission
    {
        return Mission::query()->latest('id')->first();
    }

    public function getValueProperty(): ?Values
    {
        return Values::query()->latest('id')->first();
    }

    public function getFeatureProperty(): ?Feature
    {
        return Feature::query()->latest('id')->first();
    }

    public function render()
    {
        return view('livewire.frontend.about-us-section', [
            'about' => $this->about,
            'vision' => $this->vision,
            'mission' => $this->mission,
            'value' => $this->value,
            'feature' => $this->feature,
        ]);
    }
}
