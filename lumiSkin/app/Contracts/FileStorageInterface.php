<?php

namespace App\Contracts;

interface FileStorageInterface
{
    public function store(string $path, string $content): void;
}
