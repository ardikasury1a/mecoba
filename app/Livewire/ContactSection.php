<?php

namespace App\Livewire;

use App\Models\Contact;
use Livewire\Component;

class ContactSection extends Component
{
    public string $name = '';
    public string $email = '';
    public string $subject = '';
    public string $message = '';
    public bool $sent = false;

    protected $rules = [
        'name' => 'required|min:2|max:255',
        'email' => 'required|email|max:255',
        'subject' => 'required|min:3|max:255',
        'message' => 'required|min:10',
    ];

    public function submit(): void
    {
        $this->validate();

        Contact::create([
            'name' => $this->name,
            'email' => $this->email,
            'subject' => $this->subject,
            'message' => $this->message,
        ]);

        $this->reset(['name', 'email', 'subject', 'message']);
        $this->sent = true;
    }

    public function render()
    {
        return view('livewire.contact-section');
    }
}
