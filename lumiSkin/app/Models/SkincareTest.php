<?php

/**
 * Author:
 * - Sara Valentina Cortes Manrique
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Http\Request;

class SkincareTest extends Model
{
    // ====================================================
    //                      ATTRIBUTES
    // ====================================================
    // $this->attributes['id'] - int - contains the skincare test primary key (id)
    // $this->attributes['responses'] - array[string] - contains the skincare test responses
    // $this->attributes['created_at'] - timestamp - contains the skincare test creation date
    // $this->attributes['updated_at'] - timestamp - contains the skincare test update date
    // $this->user - User - contains the associated user
    // $this->recommendations - Product[] - contains the associated products

    protected $fillable = ['user_id', 'responses'];

    // ====================================================
    //                      VALIDATION
    // ====================================================

    public static function validate(Request $request): void
    {
        $request->validate([
            'responses' => 'required|array',
            'responses.*' => 'required|string',
            'user_id' => 'required|exists:users,id',
        ]);
    }

    // ====================================================
    //                  GETTERS & SETTERS
    // ====================================================

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

    public function setUser(User $user): void
    {
        $this->user()->associate($user);
    }

    // ====================================================
    //                     RELATIONSHIPS
    // ====================================================

    // ManyToOne Relationships

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // OneToMany / ManyToMany Relationships

    public function recommendations(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_skincare_test');
    }
}
