<?php

namespace Radiocubito\Wordful\Http\Livewire;

trait WithTrixImages
{
    public $newFiles = [];

    public function completeUpload($uploadedUrl)
    {
        foreach ($this->newFiles as $image) {
            if ($image->getFilename() === $uploadedUrl) {
                $imagePath = $this->getPost()->storeImage($image);

                return $this->getPost()->getImageUrlAttribute($imagePath);
            }
        }
    }

    public function getPost()
    {
        return $this->post;
    }
}
