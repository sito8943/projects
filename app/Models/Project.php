<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Project extends Model implements HasMedia
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;

    use InteractsWithMedia;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'leading',
        'content',
        'author_id',
        'published_at',
        'github_owner',
        'github_repo',
        'github_url',
    ];

    // Model relations
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class)->orderBy('created_at', 'desc');
    }

    public function canBeManagedBy(User $user)
    {
        if ($user === null) {
            return false;
        }

        if ($user->id === $this->author_id) {
            return true;
        }

        if ($user->is_admin) {
            return true;
        }

        return false;
    }

    public function casts()
    {
        return [
            'published_at' => 'datetime',
        ];
    }

    public function registerMediaConversion(Media $media)
    {
        $this->addMediaConversion('preview')->fit(Fit::Contain, 320, 200)->nonQueued();

        $this->addMediaConversion('website')->fit(Fit::Contain, 640, 400)->nonQueued();
    }

    protected static function booted()
    {
        static::saving(function (Project $project) {
            // Generate slug if not provided
            if ($project->slug === null || $project->slug === '') {
                $project->slug = Str::slug($project->name);
            }
        });
    }

    /**
     * Marks the project as deleted while freeing the unique slug.
     */
    public function markAsDeleted(): void
    {
        $suffix = '__deleted__'.$this->id;
        $maxLen = 255; // default string length
        $currentSlug = $this->slug ?? Str::slug((string) $this->name);
        $base = substr($currentSlug, 0, max(0, $maxLen - strlen($suffix)));
        $this->slug = $base.$suffix;
        $this->save();

        // Soft delete the record
        $this->delete();
    }

    public function getImageUrl(string $conversion = 'preview'): string
    {
        if ($this->media->first()) {
            return $this->media->first()->getUrl($conversion);
        } else {
            return asset('img/placeholder.png');
        }
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Fit::Crop, 320, 200)
            ->nonQueued();

        $this
            ->addMediaConversion('website')
            ->fit(Fit::Crop, 640, 400)
            ->nonQueued();
    }
}
