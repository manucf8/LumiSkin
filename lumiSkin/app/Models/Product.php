<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    /**
     * PRODUCT ATTRIBUTES
     * $this->attributes['id'] - int - contains the product primary key (id)
     * $this->attributes['name'] - string - contains the product name
     * $this->attributes['description'] - string - contains the product description
     * $this->attributes['image'] - string - contains the product image
     * $this->attributes['brand'] - string - contains the product brand
     * $this->attributes['price'] - int - contains the product price
     * $this->attributes['created_at'] - timestamp - contains the product creation date
     * $this->attributes['updated_at'] - timestamp - contains the product update date
     *   $this->categories - Category[] - contains the associated categories
     *   $this->items - Item[] - contains the associated item
     *   $this->skincareTests - SkincareTest[] - contains the associated Skincare Test 'FALTA'
     */
    protected $fillable = ['name', 'description', 'image', 'brand', 'price'];

    public static function validate($request): void
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'required|max:255',
            'image' => 'image|mimes:jpg,jepg,png',
            'brand' => 'required|max:100',
            'price' => 'required|min:1',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
        ]);
    }

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getName(): string
    {
        return $this->attributes['name'];
    }

    public function setName(string $name): void
    {
        $this->attributes['name'] = $name;
    }

    public function getDescription(): string
    {
        return $this->attributes['description'];
    }

    public function setDescription(string $description): void
    {
        $this->attributes['description'] = $description;
    }

    public function getBrand(): string
    {
        return $this->attributes['brand'];
    }

    public function setBrand(string $brand): void
    {
        $this->attributes['brand'] = $brand;
    }

    public function getPrice(): int
    {
        return $this->attributes['price'];
    }

    public function setPrice(int $price): void
    {
        $this->attributes['price'] = $price;
    }

    public function getImage(): string
    {
        return $this->attributes['image'] ?? 'image/default.jpg';
    }

    public function setImage(string $image): void
    {
        $this->attributes['image'] = $image;
    }

    public function getCreatedAt(): string
    {
        return Carbon::parse($this->attributes['created_at'])->format('F j, Y');
    }

    public function getUpdatedAt(): Carbon
    {
        return Carbon::parse($this->attributes['updated_at']);
    }

    // Relationship categories
    public function getCategories(): string
    {
        return $this->categories->pluck('name')->join(', ');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_product');
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

    // Relationship skincare test
    public function getSkincareTests(): Collection
    {
        return $this->skincareTests;
    }

    // public function skincareTests(): HasMany
    // {
    //     return $this->hasMany(SkincareTest::class);
    // }

    public static function calculateTotal(): int
    {
        $cart = session('cart', []);

        return array_sum(array_map(fn ($item) => $item['price'] * ($item['quantity'] ?? 1), $cart));
    }

    public static function calculateTotalQuantity(): int
    {
        $cart = session('cart', []);

        return array_sum(array_map(fn ($item) => $item['quantity'] ?? 1, $cart));
    }

    public static function bestSellers(int $limit = 4): Collection
    {
        $topProducts = self::select('products.*')
            ->join('items', 'products.id', '=', 'items.product_id')
            ->selectRaw('SUM(items.quantity) as total_sold')
            ->groupBy('products.id', 'products.name', 'products.description', 'products.price', 'products.brand', 'products.image', 'products.created_at', 'products.updated_at')
            ->orderByDesc('total_sold')
            ->take($limit)
            ->get();

        return $topProducts->isNotEmpty() ? $topProducts : self::take(3)->get();
    }
}
