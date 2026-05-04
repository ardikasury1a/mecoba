<?php

namespace App\Livewire;

use App\Models\Education;
use Livewire\Component;

class EducationSection extends Component
{
    public function render()
    {
        return view('livewire.education-section', [
            'educations' => Education::ordered()->get(),
        ]);
    }
}
