<?php

namespace App\Livewire\Frontend;

use App\Models\PrivacyAndPolicy;
use Livewire\Component;

class PrivacyPolicyPageSection extends Component
{
    public function getPrivacyProperty(): ?PrivacyAndPolicy
    {
        $privacy = PrivacyAndPolicy::first();

        if (!$privacy) {
            $privacy = new PrivacyAndPolicy();
        }
        return $privacy;
    }

    public function render()
    {
        return view('livewire.frontend.privacy-policy-page-section', [
            'privacy' => $this->privacy,
        ]);
    }
}
