<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $table = 'educations';

    protected $fillable = [
        'institution', 'degree', 'field_of_study', 'start_year', 'end_year',
        'description', 'sort_order', 'degree_en', 'field_of_study_en', 'description_en',
    ];

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    public function getLocalizedDegreeAttribute(): ?string
    {
        $locale = app()->getLocale();
        if ($locale === 'en' && $this->degree_en) {
            return $this->degree_en;
        }
        return $this->degree;
    }

    public function getLocalizedFieldOfStudyAttribute(): ?string
    {
        $locale = app()->getLocale();
        if ($locale === 'en' && $this->field_of_study_en) {
            return $this->field_of_study_en;
        }
        return $this->field_of_study;
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
        $end = $this->end_year ?? __('Sekarang');
        return "{$this->start_year} - {$end}";
    }
}
