<?php

namespace App\Livewire;

use App\Models\Project;
use Livewire\Component;

class ProjectsSection extends Component
{
    public string $activeFilter = 'all';

    public function setFilter(string $filter): void
    {
        $this->activeFilter = $filter;
    }

    public function render()
    {
        $query = Project::ordered();

        if ($this->activeFilter !== 'all') {
            $query->where('category', $this->activeFilter);
        }

        return view('livewire.projects-section', [
            'projects' => $query->get(),
            'categories' => Project::distinct()->pluck('category'),
        ]);
    }
}
