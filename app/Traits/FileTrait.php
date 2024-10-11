<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait FileTrait
{
    /**
     * Delete specified file in storage.
     * @param string $file
     * @return void
     */
    public function remove(string $file): void
    {
        if ($this->exist($file)) {
            Storage::disk('public')->delete($file); 
        }
    }

    /**
     * Check if specified file exists in storage.
     * @param string $file
     * @return bool
     */
    public function exist(string $file): bool
    {
        return Storage::disk('public')->exists($file);
    }

    /**
     * Handle upload file to storage in the 'public' disk.
     * @param string $disk
     * @param UploadedFile $file
     * @param bool $originalName
     * @return string
     */
    public function upload(string $disk, UploadedFile $file, bool $originalName = false): string
    {
        // Ensure the directory exists in the 'public' disk
        if (!$this->exist($disk)) {
            Storage::disk('public')->makeDirectory($disk);
        }

        // Upload file with original name or generated name
        if ($originalName) {
            return $file->storeAs($disk, $file->getClientOriginalName(), 'public');
        }

        return $file->store($disk, 'public');
    }
}
