<?php

namespace App\Livewire\Frontend;

use App\Models\PrivacyAndPolicy;
use Livewire\Component;

class PrivacyPolicyPageSection extends Component
{
    public function getPrivacyProperty(): ?PrivacyAndPolicy
    {
        return PrivacyAndPolicy::query()->latest('id')->first();
    }

    public function render()
    {
        return view('livewire.frontend.privacy-policy-page-section', [
            'privacy' => $this->privacy,
        ]);
    }
}
