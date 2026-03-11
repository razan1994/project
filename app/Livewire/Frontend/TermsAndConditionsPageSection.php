<?php

namespace App\Livewire\Frontend;

use App\Models\TermAndCondition;
use Livewire\Component;

class TermsAndConditionsPageSection extends Component
{
    public function getTermsProperty(): ?TermAndCondition
    {
        return TermAndCondition::query()->latest('id')->first();
    }

    public function render()
    {
        return view('livewire.frontend.terms-and-conditions-page-section', [
            'terms' => $this->terms,
        ]);
    }
}
