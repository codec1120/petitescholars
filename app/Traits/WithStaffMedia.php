<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait WithStaffMedia
{
    public function setFieldFileExtension(string $key, string $extension): void
    {
        $this->setMeta($key, $extension);
    }

    public function getFieldFileExtension(string $key)
    {
        return $this->getMeta($key);
    }

    public function getClearanceDirectory(): string
    {
        return "{$this->storagePath()}/clearance";
    }

    public function getTrainingDirectory(): string
    {
        return "{$this->storagePath()}/training";
    }

    public function getRequirementsDirectory(): string
    {
        return "{$this->storagePath()}/requirement";
    }

    public function hasFileUploaded(string $directory, string $filename): bool
    {
        return Storage::disk('spaces')->has(
            "{$directory}/{$filename}"
        );
    }
}
