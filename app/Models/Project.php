<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'header_image_path',
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
}
