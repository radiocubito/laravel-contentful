<?php

namespace Radiocubito\Contentful\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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

    public function getExcerptAttribute($imagePath)
    {
        return Str::of(strip_tags(str_replace('<br>', ' ', $this->html)))->words(60);
    }

    public function scopePublished($query)
    {
        return $query->whereStatus('published');
    }

    public function scopeDraft($query)
    {
        return $query->whereStatus('draft');
    }

    public function isPublished()
    {
        return $this->status === 'published';
    }

    public function isDraft()
    {
        return $this->status === 'draft';
    }

    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
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
        return isset($_ENV['VAPOR_ARTIFACT_NAME']) ? 's3' : config('contentful.images_disk', 'public');
    }
}
