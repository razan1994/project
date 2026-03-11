<?php

namespace App\Livewire\Frontend;

use App\Models\Slider;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class SliderSection extends Component
{
    public function getSlidersProperty(): Collection
    {
        return Slider::query()
            ->where('status', 1)
            ->orderByDesc('id')
            ->get();
    }

    public function render()
    {
        return view('livewire.frontend.slider-section', [
            'sliders' => $this->sliders,
            'heroSlider' => $this->sliders->first(),
        ]);
    }
}
