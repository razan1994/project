<?php

namespace App\Livewire\Frontend;

use App\Models\Faq;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class FaqsPageSection extends Component
{
    public function getFaqsProperty(): Collection
    {
        return Faq::query()->active()->get();
    }

    public function getLeftFaqsProperty(): Collection
    {
        return $this->faqs->values()->filter(fn ($_, int $index) => $index % 2 === 0)->values();
    }

    public function getRightFaqsProperty(): Collection
    {
        return $this->faqs->values()->filter(fn ($_, int $index) => $index % 2 !== 0)->values();
    }

    public function render()
    {
        return view('livewire.frontend.faqs-page-section', [
            'leftFaqs' => $this->leftFaqs,
            'rightFaqs' => $this->rightFaqs,
        ]);
    }
}
