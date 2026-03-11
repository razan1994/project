<?php

namespace App\Livewire\Frontend;

use App\Models\Service;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class ServicesPageSection extends Component
{
    protected array $icons = [
        'icon-crane2',
        'icon-drill',
        'icon-brickwall',
        'icon-energy-saving',
        'icon-pencil_art',
        'icon-improvement',
        'icon-barrier',
        'icon-apartment',
    ];

    public function getServicesProperty(): Collection
    {
        return Service::query()
            ->where('status', 1)
            ->orderByDesc('id')
            ->get();
    }

    public function iconFor(int $index): string
    {
        return $this->icons[$index % count($this->icons)];
    }

    public function render()
    {
        return view('livewire.frontend.services-page-section', [
            'services' => $this->services,
            'featuredService' => $this->services->first(),
        ]);
    }
}
