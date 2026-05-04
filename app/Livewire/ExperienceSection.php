<?php

namespace App\Livewire;

use App\Models\Experience;
use Livewire\Component;

class ExperienceSection extends Component
{
    public function render()
    {
        return view('livewire.experience-section', [
            'experiences' => Experience::ordered()->get(),
        ]);
    }
}
