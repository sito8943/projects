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
    use SoftDeletes;
    use InteractsWithMedia;

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
        return $this->hasMany(Review::class);
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
            'published_at' => 'datetime'
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
}
