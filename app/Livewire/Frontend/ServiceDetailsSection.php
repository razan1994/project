<?php

namespace App\Livewire\Frontend;

use App\Models\Service;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class ServiceDetailsSection extends Component
{
    public Service $service;

    public function mount(Service $service): void
    {
        $this->service = $service;
    }

    public function getServicesProperty(): Collection
    {
        return Service::query()
            ->where('status', 1)
            ->orderByDesc('id')
            ->get();
    }

    public function render()
    {
        return view('livewire.frontend.service-details-section', [
            'services' => $this->services,
        ]);
    }
}
