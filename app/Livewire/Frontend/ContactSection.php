<?php

namespace App\Livewire\Frontend;

use App\Models\ContactUs;
use App\Models\ContactUsRequest;
use Livewire\Component;

class ContactSection extends Component
{
    public string $full_name = '';
    public string $email = '';
    public string $phone = '';
    public string $subject = '';
    public string $message = '';

    protected array $rules = [
        'full_name' => ['required', 'string', 'min:2', 'max:255'],
        'email' => ['required', 'email', 'max:255'],
        'phone' => ['required', 'string', 'max:255'],
        'subject' => ['required', 'string', 'max:255'],
        'message' => ['required', 'string', 'min:5'],
    ];

    public function getContactProperty(): ?ContactUs
    {
        return ContactUs::query()->first();
    }

    public function submit(): void
    {
        $validated = $this->validate();

        ContactUsRequest::query()->create($validated);

        $this->reset(['full_name', 'email', 'phone', 'subject', 'message']);

        session()->flash('contact_success', 'Your message has been sent successfully.');
    }

    public function render()
    {
        return view('livewire.frontend.contact-section', [
            'contact' => $this->contact,
        ]);
    }
}
