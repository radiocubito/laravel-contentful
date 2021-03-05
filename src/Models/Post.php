<?php

namespace Radiocubito\Contentful\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function markAsPublished()
    {
        $this->update([
            'published_at' => $this->published_at ?? $this->freshTimestamp(),
            'status' => 'published',
        ]);
    }
}
