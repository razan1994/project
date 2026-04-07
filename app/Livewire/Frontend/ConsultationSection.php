<?php

namespace App\Livewire\Frontend;

use App\Mail\ConsultationEmail;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class ConsultationSection extends Component
{
    public string $client_name = '';
    public string $contact_number = '';
    public string $preferred_time = '';
    public string $building_type = '';
    public string $approved_design = '';
    public string $land_area = '';
    public string $construction_area = '';
    public $attachments = [];

    protected array $rules = [
        'client_name' => ['required', 'string', 'min:2', 'max:255'],
        'contact_number' => ['required', 'string', 'max:255'],
        'building_type' => ['required', 'string', 'max:255'],
        'approved_design' => ['required', 'string', 'max:255'],
    ];

    public function submit(): void
    {
        $validated = $this->validate();
        // Send email to admin
        Mail::to(config('mail.from.address'))->send(new ConsultationEmail($validated + [
            'preferred_time' => $this->preferred_time,
            'land_area' => $this->land_area,
            'construction_area' => $this->construction_area,
        ]));
        $this->reset(['client_name', 'contact_number', 'preferred_time', 'building_type', 'approved_design', 'land_area', 'construction_area']);
        session()->flash('consult_success', 'Your request has been sent successfully.');
    }

    public function render()
    {
        return view('livewire.frontend.consultation-section');
    }
}
