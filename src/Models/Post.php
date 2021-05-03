<?php

namespace Radiocubito\Wordful\Models;

use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Radiocubito\Wordful\Database\Factories\PostFactory;
use Radiocubito\Wordful\Wordful;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Post extends Model
{
    use HasFactory;
    use HasSlug;

    protected $guarded = [];

    protected $casts = [
        'author_id' => 'integer',
        'published_at' => 'date:Y-m-d H:i:s',
        'meta' => AsCollection::class,
    ];

    protected static function newFactory()
    {
        return PostFactory::new();
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function author()
    {
        return $this->belongsTo(Wordful::userModel());
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'posts_tags', 'post_id', 'tag_id');
    }

    public function markAsPublished(): void
    {
        $this->update([
            'published_at' => $this->published_at ?? $this->freshTimestamp(),
            'status' => 'published',
        ]);
    }

    public function getExcerptAttribute(): string
    {
        return Str::of(strip_tags(str_replace('<br>', ' ', html_entity_decode($this->html))))->words(60);
    }

    public function scopePublished($query): void
    {
        $query->whereStatus('published');
    }

    public function scopeDraft($query): void
    {
        $query->whereStatus('draft');
    }

    public function scopeOfType($query, $type): void
    {
        $query->where('type', $type);
    }

    public function scopeTag($query, string $slug): void
    {
        $query->whereHas('tags', function ($query) use ($slug) {
            $query->where('slug', $slug);
        });
    }

    public function isPublished(): bool
    {
        return $this->status === 'published';
    }

    public function isDraft(): bool
    {
        return $this->status === 'draft';
    }

    public function customExcerptEnabled(): bool
    {
        return ! is_null($this->custom_excerpt);
    }

    public function customMetaDataEnabled(): bool
    {
        if (is_null($this->meta)) {
            return false;
        }

        return (bool) ($this->meta['meta_title'] ?? false)
            || (bool) ($this->meta['meta_description'] ?? false);
    }

    public function storeImage(UploadedFile $image)
    {
        return $image->storePublicly('post-images', ['disk' => $this->imagesDisk()]);
    }

    public function getImageUrlAttribute($imagePath): string
    {
        return Storage::disk($this->imagesDisk())->url($imagePath);
    }

    protected function imagesDisk(): string
    {
        return isset($_ENV['VAPOR_ARTIFACT_NAME']) ? 's3' : config('wordful.images_disk', 'public');
    }
}
