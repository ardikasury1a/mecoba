<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'name', 'position', 'company', 'avatar', 'content',
        'rating', 'is_active', 'sort_order', 'content_en',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    public function getLocalizedContentAttribute(): ?string
    {
        $locale = app()->getLocale();
        if ($locale === 'en' && $this->content_en) {
            return $this->content_en;
        }
        return $this->content;
    }
}
