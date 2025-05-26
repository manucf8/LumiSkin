<?php

/**
 * Author:
 * - Juan Pablo Zuluaga Peláez
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;

class Item extends Model
{
    // ====================================================
    //                      ATTRIBUTES
    // ====================================================
    // $this->attributes['id'] - int - contains the item primary key (id)
    // $this->attributes['quantity'] - int - contains the quantity of each product
    // $this->attributes['price'] - int - contains the product price
    // $this->attributes['subtotal'] - int - contains the subtotal of each item
    // $this->attributes['created_at'] - timestamp - contains the item creation date
    // $this->attributes['updated_at'] - timestamp - contains the item update date
    // $this->attributes['product_id'] - int - contains the referenced product id
    // $this->attributes['order_id'] - int - contains the referenced order id
    // $this->product - Product - contains the associated product
    // $this->order - Order - contains the associated order

    protected $fillable = ['quantity', 'subtotal', 'price', 'product_id', 'order_id'];

    // ====================================================
    //                      VALIDATION
    // ====================================================

    public static function validate(Request $request): void
    {
        $request->validate([
            'quantity' => 'required|int|min:1',
            'subtotal' => 'required|int|min:1',
            'price' => 'required|int|min:1',
            'product_id' => 'required|exists:products,id',
            'order_id' => 'required|exists:orders,id',
        ]);
    }

    // ====================================================
    //                  GETTERS & SETTERS
    // ====================================================

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getQuantity(): int
    {
        return $this->attributes['quantity'];
    }

    public function setQuantity(int $quantity): void
    {
        $this->attributes['quantity'] = $quantity;
    }

    public function getPrice(): int
    {
        return $this->attributes['price'];
    }

    public function setPrice(int $price): void
    {
        $this->attributes['price'] = $price;
    }

    public function getSubtotal(): int
    {
        return $this->attributes['subtotal'];
    }

    public function setSubtotal(int $subtotal): void
    {
        $this->attributes['subtotal'] = $subtotal;
    }

    public function getCreatedAt(): Carbon
    {
        return Carbon::parse($this->attributes['created_at']);
    }

    public function getUpdatedAt(): Carbon
    {
        return Carbon::parse($this->attributes['updated_at']);
    }

    public function getProductId(): int
    {
        return $this->attributes['product_id'];
    }

    public function setProductId(int $productID): void
    {
        $this->attributes['product_id'] = $productID;
    }

    public function getOrderId(): int
    {
        return $this->attributes['order_id'];
    }

    public function setOrderId(int $orderID): void
    {
        $this->attributes['order_id'] = $orderID;
    }

    // ====================================================
    //                  RELATIONSHIPS
    // ====================================================

    // ManyToOne Relationships

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    // OneToMany / ManyToMany Relationships
}
