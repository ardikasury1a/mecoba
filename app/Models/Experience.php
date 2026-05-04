<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = [
        'company', 'position', 'description', 'start_date', 'end_date',
        'is_current', 'sort_order', 'position_en', 'description_en',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_current' => 'boolean',
    ];

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    public function getLocalizedPositionAttribute(): ?string
    {
        $locale = app()->getLocale();
        if ($locale === 'en' && $this->position_en) {
            return $this->position_en;
        }
        return $this->position;
    }

    public function getLocalizedDescriptionAttribute(): ?string
    {
        $locale = app()->getLocale();
        if ($locale === 'en' && $this->description_en) {
            return $this->description_en;
        }
        return $this->description;
    }

    public function getPeriodAttribute(): string
    {
        $start = $this->start_date->format('M Y');
        $end = $this->is_current ? __('Sekarang') : ($this->end_date?->format('M Y') ?? '');
        return "{$start} - {$end}";
    }
}
