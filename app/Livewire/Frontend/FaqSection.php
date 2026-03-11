<?php

namespace App\Livewire\Frontend;

use App\Models\Faq;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class FaqSection extends Component
{
    public function getFaqsProperty(): Collection
    {
        return Faq::query()->active()->get();
    }

    public function render()
    {
        return view('livewire.frontend.faq-section', [
            'faqs' => $this->faqs,
        ]);
    }
}
