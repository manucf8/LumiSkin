<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SkincareTest extends Model
{
    /**
     * ATTRIBUTES
     * $this->attributes['id'] - int - contains the skincare test primary key (id)
     * $this->attributes['responses'] - Array[string] - contains the skincare test responses
     * $this->attributes['created_at'] - timestamp - contains the skincare test creation date
     * $this->attributes['updated_at'] - timestamp - contains the skincare test update date
     * $this->attributes['user'] - User - contains the associated user
     * $this->recommendations - Product[] - contains the associated products
     */
    public static function validate($request): void
    {
        $request->validate([
            'responses' => 'required|array',
            'user' => 'required|exists:users,id',
        ]);
    }

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getResponses(): array
    {
        return json_decode($this->attributes['responses'], true);
    }

    public function setResponses(array $responses): void
    {
        $this->attributes['responses'] = json_encode($responses);
    }

    public function getCreatedAt(): string
    {
        return $this->attributes['created_at'];
    }

    public function getUpdatedAt(): string
    {
        return $this->attributes['updated_at'];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function recommendations(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
