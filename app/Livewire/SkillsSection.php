<?php

namespace App\Livewire;

use App\Models\Skill;
use Livewire\Component;

class SkillsSection extends Component
{
    public function render()
    {
        return view('livewire.skills-section', [
            'skills' => Skill::active()->ordered()->get(),
            'categories' => Skill::active()->distinct()->pluck('category'),
        ]);
    }
}
