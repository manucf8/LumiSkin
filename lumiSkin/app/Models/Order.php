<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;

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
    protected $fillable = ['user_id', 'total', 'delivery_date'];

    public static function validate(Request $request): void
    {
        $request->validate([
            'delivery_date' => 'required|date|after:today',
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

    public function getDeliveryDate(): string
    {
        return Carbon::parse($this->attributes['delivery_date'])
            ->startOfDay()
            ->format('M d, Y');
    }

    public function setDeliveryDate(Carbon|string $date): void
    {
        $this->attributes['delivery_date'] = Carbon::parse($date)->toDateString();
    }

    public function getCreatedAt(): string
    {
        return Carbon::parse($this->attributes['created_at'])->format('M d, Y H:i');
    }

    public function getUpdatedAt(): Carbon
    {
        return Carbon::parse($this->attributes['updated_at']);
    }

    public function getUserId(): int
    {
        return $this->attributes['user_id'];
    }

    public function setUserId(int $userID): void
    {
        $this->attributes['user_id'] = $userID;
    }

    public function getCustomerName(): string
    {
        return $this->user->name;
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
