<?php

namespace App\Services;

use App\Contracts\FileStorageInterface;
use Illuminate\Support\Facades\Storage;

class LocalFileStorageService implements FileStorageInterface {
    public function store(string $path, string $content): void
    {
        Storage::disk('public')->put($path, $content);
    }
}
