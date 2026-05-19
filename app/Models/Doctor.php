<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use App\Traits\HandlesMediaUpload;

class Doctor extends Model implements HasMedia
{
    use InteractsWithMedia, LogsActivity, HandlesMediaUpload;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'department_id',
        'specialization',
        'experience_years',
        'consultation_fee',
        'hospital_name',
        'bio',
        'is_featured',
        'status',
        'social_links'
    ];

    protected $casts = [
        'social_links' => 'array',
        'is_featured' => 'boolean',
        'status' => 'boolean',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->logOnlyDirty()
            ->useLogName('doctor');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function educations(): HasMany
    {
        return $this->hasMany(DoctorEducation::class);
    }

    public function experiences(): HasMany
    {
        return $this->hasMany(DoctorExperience::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('profile_image')
            ->singleFile()
            ->useFallbackUrl(asset('assets/images/default-doctor.png'));
    }

    public function getFirstMediaUrl(string $collectionName = 'default', string $conversionName = ''): string
    {
        $media = $this->getFirstMedia($collectionName);
        
        if ($media && file_exists($media->getPath($conversionName))) {
            return $media->getUrl($conversionName);
        }
        
        if ($collectionName === 'profile_image') {
            return asset('assets/images/default-doctor.png');
        }
        
        return $media ? $media->getUrl($conversionName) : ($this->getFallbackMediaUrl($collectionName, $conversionName) ?: '');
    }

    public function hasMedia(string $collectionName = 'default'): bool
    {
        $media = $this->getFirstMedia($collectionName);
        
        return $media && file_exists($media->getPath());
    }

    public function wishlistedBy()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function chambers()
    {
        return $this->hasMany(Chamber::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function getAverageRatingAttribute()
    {
        return round($this->reviews()->where('status', true)->avg('rating') ?? 0, 1);
    }

    public function getReviewsCountAttribute()
    {
        return $this->reviews()->where('status', true)->count();
    }

    public function getNameAttribute($value)
    {
        return $value ?: optional($this->user)->name;
    }

    public function getEmailAttribute($value)
    {
        return $value ?: optional($this->user)->email;
    }
}
