<?php

namespace App\Livewire\Frontend;

use App\Models\Service;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class ServicesPageSection extends Component
{

    public function getServicesProperty(): Collection
    {
        return Service::query()
            ->where('status', 1)
            ->orderBy('id', 'asc')
            ->get();
    }


    public function render()
    {
        return view('livewire.frontend.services-page-section', [
            'services' => $this->services,
            'featuredService' => $this->services->first(),
        ]);
    }
}
