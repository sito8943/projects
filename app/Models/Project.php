<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Project extends Model implements HasMedia
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
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
        'is_published',
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
            'is_published' => 'bool'
        ];
    }

    public function registerMediaConversion(Media $media)
    {
        $this->addMediaConversion('preview')->fit(Fit::Contain, 320, 200)->nonQueued();

        $this->addMediaConversion('website')->fit(Fit::Contain, 640, 400)->nonQueued();
    }
}
