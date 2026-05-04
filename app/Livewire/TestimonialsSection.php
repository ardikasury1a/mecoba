<?php

namespace App\Livewire;

use App\Models\Testimonial;
use Livewire\Component;

class TestimonialsSection extends Component
{
    public function render()
    {
        return view('livewire.testimonials-section', [
            'testimonials' => Testimonial::active()->ordered()->get(),
        ]);
    }
}
