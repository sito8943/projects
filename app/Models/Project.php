<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;

    // Model relations
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
