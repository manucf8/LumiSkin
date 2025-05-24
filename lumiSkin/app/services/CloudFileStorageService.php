<?php

/**
 * Author:
 * - Sara Valentina Cortes Manrique 
 */

namespace App\Services;

use App\Contracts\FileStorageInterface;
use Illuminate\Support\Facades\Storage;

class CloudFileStorageService implements FileStorageInterface
{
    public function store(string $path, string $content): void
    {
        Storage::disk('s3')->put($path, $content);
    }
}
