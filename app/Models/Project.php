<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    protected $fillable = [
        'title', 'slug', 'description', 'image', 'tech_stack',
        'live_url', 'github_url', 'category', 'is_featured', 'sort_order',
        'title_en', 'description_en',
    ];

    protected $casts = [
        'tech_stack' => 'array',
        'is_featured' => 'boolean',
    ];

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function getLocalizedTitleAttribute(): ?string
    {
        $locale = app()->getLocale();
        if ($locale === 'en' && $this->title_en) {
            return $this->title_en;
        }
        return $this->title;
    }

    public function getLocalizedDescriptionAttribute(): ?string
    {
        $locale = app()->getLocale();
        if ($locale === 'en' && $this->description_en) {
            return $this->description_en;
        }
        return $this->description;
    }

    protected static function booted(): void
    {
        static::creating(function ($project) {
            if (empty($project->slug)) {
                $project->slug = Str::slug($project->title);
            }
        });
    }
}
