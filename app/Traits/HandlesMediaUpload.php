<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;

trait HandlesMediaUpload
{
    /**
     * Upload or update media for a model collection.
     *
     * @param UploadedFile $file
     * @param string $collection
     * @param bool $isUpdate
     * @return void
     */
    public function uploadOrUpdateMedia(UploadedFile $file, string $collection = 'profile_image', bool $isUpdate = false): void
    {
        if ($isUpdate) {
            $this->clearMediaCollection($collection);
        }

        $extension = $file->getClientOriginalExtension();
        $fileName = $this->id . '_' . $collection . '.' . $extension;

        $this->addMedia($file)
             ->usingFileName($fileName)
             ->toMediaCollection($collection);
    }
}
