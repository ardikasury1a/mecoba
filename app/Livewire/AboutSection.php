<?php

namespace App\Livewire;

use App\Models\Profile;
use Livewire\Component;

class AboutSection extends Component
{
    public function render()
    {
        return view('livewire.about-section', [
            'profile' => Profile::first(),
        ]);
    }
}
