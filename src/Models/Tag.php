<?php

namespace Radiocubito\Wordful\Models;

use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Tag extends Model
{
    use HasFactory;
    use HasSlug;

    protected $guarded = [];

    protected $casts = [
        'meta' => AsCollection::class,
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'posts_tags', 'tag_id', 'post_id');
    }

    public function customMetaDataEnabled(): bool
    {
        if (is_null($this->meta)) {
            return false;
        }

        return (bool) ($this->meta['meta_title'] ?? false)
            || (bool) ($this->meta['meta_description'] ?? false);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($item) {
            $item->posts()->detach();
        });
    }
}
