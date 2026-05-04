<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'name', 'tagline', 'bio', 'avatar', 'resume_url',
        'email', 'phone', 'address',
        'github_url', 'linkedin_url', 'instagram_url', 'twitter_url', 'website_url',
        'name_en', 'tagline_en', 'bio_en',
    ];

    /**
     * Get localized attribute based on current locale.
     */
    public function getLocalizedAttribute(string $attribute): ?string
    {
        $locale = app()->getLocale();
        if ($locale === 'en' && $this->getAttribute("{$attribute}_en")) {
            return $this->getAttribute("{$attribute}_en");
        }
        return $this->getAttribute($attribute);
    }

    public function getLocalizedNameAttribute(): ?string
    {
        return $this->getLocalizedAttribute('name');
    }

    public function getLocalizedTaglineAttribute(): ?string
    {
        return $this->getLocalizedAttribute('tagline');
    }

    public function getLocalizedBioAttribute(): ?string
    {
        return $this->getLocalizedAttribute('bio');
    }
}
