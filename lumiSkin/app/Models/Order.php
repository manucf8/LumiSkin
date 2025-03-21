<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;

class Order extends Model
{
    use HasFactory;

    /**
     * ORDER ATTRIBUTES
     * $this->attributes['id'] - int - contains the order primary key (id)
     * $this->attributes['total'] - int - contains the order total
     * $this->attributes['delivery_date'] - date - contains the delivery date
     * $this->attributes['created_at'] - timestamp - contains the order creation date
     * $this->attributes['updated_at'] - timestamp - contains the order update date
     * $this->attributes['user_id'] - int - contains the user id
     * $this->items - Item[] - contains the associated items
     */

    protected $fillable = ['total', 'delivery_date', 'user_id'];

    public static function validate($request): void
    {
        $request->validate([
            'total' => 'required|integer|min:1',
            'delivery_date' => 'required|date|after:today',
            // 'user_id' => 'required|exists:users,id'
        ]);
    }

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getTotal(): int
    {
        return $this->attributes['total'];
    }

    public function setTotal(int $total): void
    {
        $this->attributes['total'] = $total;
    }

    public function getDeliveryDate(): Carbon
    {
        return Carbon::parse($this->attributes['delivery_date'])->startOfDay();
    }

    public function setDeliveryDate(Carbon|string $date): void
    {
        $this->attributes['delivery_date'] = Carbon::parse($date)->toDateString();
    }

    public function getCreatedAt(): Carbon
    {
        return Carbon::parse($this->attributes['created_at']);
    }

    public function getUpdatedAt(): Carbon
    {
        return Carbon::parse($this->attributes['updated_at']);
    }

    public function getUserId(): int
    {
        return $this->attributes['user_id'];
    }

    public function setUserId(int $uId): void
    {
        $this->attributes['user_id'] = $uId;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relationship Items
    public function getItems(): Collection
    {
        return $this->items;
    }

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }
}
