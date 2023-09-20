<?php

namespace App\Traits\MediaLibrary;

use Spatie\MediaLibrary\InteractsWithMedia as ParentInteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\FileAdder;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

trait InteractsWithMedia {
    use ParentInteractsWithMedia {
        ParentInteractsWithMedia::addMedia as parentAddMedia;
        ParentInteractsWithMedia::addMediaFromRequest as parentAddMediaFromRequest;
    }

    public function getLastMedia(string $collectionName = 'default', $filters = []): ?Media
    {
        $media = $this->getMedia($collectionName, $filters);

        return $media->last();
    }

    /*
     * Get the url of the image for the given conversionName
     * for last media for the given collectionName.
     * If no profile is given, return the source's url.
     */
    public function getLastMediaUrl(string $collectionName = 'default', string $conversionName = ''): string
    {
        $media = $this->getMedia($collectionName);

        if ($media->isEmpty()) {
            return $this->getFallbackMediaUrl($collectionName) ?: '';
        }

        return $media->last()->getUrl($conversionName);
    }

    /**
     * Store Media With FileName Hashed
     * 
     * @param string|\Symfony\Component\HttpFoundation\File\UploadedFile $file
     * @return \Spatie\MediaLibrary\MediaCollections\FileAdder
     */
    public function addMedia($file, $name = null): FileAdder
    {
        $name = $name ?? pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        \error_log("Registrando: {$name}");
        $array_transform = ['#', '/', '\\', '-', '_'];
        return $this->parentAddMedia($file)
            ->usingName(str_replace($array_transform, ' ', $name))
            ->usingFileName($file->hashName());
    }
}