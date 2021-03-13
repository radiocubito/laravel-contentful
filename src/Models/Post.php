<?php

namespace Radiocubito\Wordful\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Radiocubito\Wordful\Wordful;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function author()
    {
        return $this->belongsTo(Wordful::userModel());
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'posts_tags', 'post_id', 'tag_id');
    }

    public function markAsPublished()
    {
        $this->update([
            'published_at' => $this->published_at ?? $this->freshTimestamp(),
            'status' => 'published',
        ]);
    }

    public function getExcerptAttribute()
    {
        return Str::of(strip_tags(str_replace('<br>', ' ', html_entity_decode($this->html))))->words(60);
    }

    public function scopePublished($query)
    {
        return $query->whereStatus('published');
    }

    public function scopeDraft($query)
    {
        return $query->whereStatus('draft');
    }

    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeTag($query, string $slug)
    {
        return $query->whereHas('tags', function ($query) use ($slug) {
            $query->where('slug', $slug);
        });
    }

    public function isPublished()
    {
        return $this->status === 'published';
    }

    public function isDraft()
    {
        return $this->status === 'draft';
    }

    public function storeImage(UploadedFile $image)
    {
        return $image->storePublicly('post-images', ['disk' => $this->imagesDisk()]);
    }

    public function getImageUrlAttribute($imagePath)
    {
        return Storage::disk($this->imagesDisk())->url($imagePath);
    }

    protected function imagesDisk()
    {
        return isset($_ENV['VAPOR_ARTIFACT_NAME']) ? 's3' : config('wordful.images_disk', 'public');
    }
}
