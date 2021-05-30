<?php

namespace Radiocubito\Wordful\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait HasIdentityImages
{
    public function updateLogo(UploadedFile $logo): void
    {
        tap($this->logo_path, function ($previous) use ($logo) {
            $this->put([
                'logo_path' => $logo->storePublicly(
                    'identity-images',
                    ['disk' => $this->wordfulImagesDisk()]
                )
            ]);

            if ($previous) {
                Storage::disk($this->wordfulImagesDisk())->delete($previous);
            }
        });
    }

    public function updateIcon(UploadedFile $icon): void
    {
        tap($this->icon_path, function ($previous) use ($icon) {
            $this->put([
                'icon_path' =>
                $icon->storePublicly(
                    'identity-images',
                    ['disk' => $this->wordfulImagesDisk()]
                )
            ]);

            if ($previous) {
                Storage::disk($this->wordfulImagesDisk())->delete($previous);
            }
        });
    }

    public function deleteLogo(): void
    {
        Storage::disk($this->wordfulImagesDisk())->delete($this->logo_path);

        $this->put('logo_path', null);
    }

    public function deleteIcon(): void
    {
        Storage::disk($this->wordfulImagesDisk())->delete($this->icon_path);

        $this->put('icon_path', null);
    }

    public function getLogoUrlAttribute(): string
    {
        return $this->logo_path
                    ? Storage::disk($this->wordfulImagesDisk())->url($this->logo_path)
                    : $this->defaultLogoUrl();
    }

    public function getIconUrlAttribute(): string
    {
        return $this->icon_path
                    ? Storage::disk($this->wordfulImagesDisk())->url($this->icon_path)
                    : $this->defaultLogoUrl();
    }

    protected function defaultLogoUrl(): string
    {
        $hash = md5(strtolower(trim($this->email)));

        return "http://www.gravatar.com/avatar/{$hash}?s=64";
    }

    protected function defaultIconUrl(): string
    {
        $hash = md5(strtolower(trim($this->email)));

        return "http://www.gravatar.com/avatar/{$hash}?s=64";
    }

    protected function wordfulImagesDisk(): string
    {
        return isset($_ENV['VAPOR_ARTIFACT_NAME']) ? 's3' : config('wordful.images_disk', 'public');
    }
}
