<?php

namespace App\Livewire\Frontend;

use App\Models\About;
use Livewire\Component;

class AboutSection extends Component
{
    public function getAboutProperty(): ?About
    {
        return About::query()->first();
    }

    public function render()
    {
        return view('livewire.frontend.about-section', [
            'about' => $this->about,
        ]);
    }
}
