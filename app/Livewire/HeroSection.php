<?php

namespace App\Livewire;

use App\Models\Profile;
use Livewire\Component;

class HeroSection extends Component
{
    public function render()
    {
        return view('livewire.hero-section', [
            'profile' => Profile::first(),
        ]);
    }
}
