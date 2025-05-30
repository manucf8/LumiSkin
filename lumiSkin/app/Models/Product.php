<?php

/**
 * Author:
 * - Juan Pablo Zuluaga Peláez
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Product extends Model
{
    // ====================================================
    //                      ATTRIBUTES
    // ====================================================
    // $this->attributes['id'] - int - contains the product primary key (id)
    // $this->attributes['name'] - string - contains the product name
    // $this->attributes['description'] - string - contains the product description
    // $this->attributes['image'] - string - contains the product image
    // $this->attributes['brand'] - string - contains the product brand
    // $this->attributes['price'] - int - contains the product price
    // $this->attributes['created_at'] - timestamp - contains the product creation date
    // $this->attributes['updated_at'] - timestamp - contains the product update date
    // $this->categories - Category[] - contains the associated categories
    // $this->items - Item[] - contains the associated items
    // $this->skincareTests - SkincareTest[] - contains the associated Skincare Tests

    protected $fillable = ['name', 'description', 'image', 'brand', 'price'];


    // ====================================================
    //                     VALIDATION
    // ====================================================

    public static function validate(Request $request): void
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

    // ====================================================
    //                  GETTERS & SETTERS
    // ====================================================

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
        return Str::limit($this->attributes['description'], 60);
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

    // ====================================================
    //                  RELATIONSHIPS
    // ====================================================

    // ManyToOne Relationships

    // OneToMany / ManyToMany Relationships

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_product');
    }

    public function getCategories(): string
    {
        return $this->categories->pluck('name')->join(', ');
    }

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }

    public function getItems(): Collection
    {
        return $this->items;
    }

    public function skincareTests(): BelongsToMany
    {
        return $this->belongsToMany(SkincareTest::class, 'product_skincare_test');
    }

    public function getSkincareTests(): Collection
    {
        return $this->skincareTests;
    }

    // ====================================================
    //          BUSINESS LOGIC / UTILITY METHODS
    // ====================================================

    public static function calculateTotal(): int
    {
        $cart = session('cart', []);
        $total = 0;

        foreach ($cart as $id => $quantity) {
            $product = Product::find($id);
            if ($product) {
                $total += $product->getPrice() * $quantity;
            }
        }

        return $total;
    }

    public static function calculateTotalQuantity(): int
    {
        $cart = session('cart', []);
        return array_sum($cart);
    }

    public static function bestSellers(int $limit = 4): Collection
    {
        $topProducts = self::select('products.*')
            ->join('items', 'products.id', '=', 'items.product_id')
            ->selectRaw('SUM(items.quantity) as total_sold')
            ->groupBy(
                'products.id',
                'products.name',
                'products.description',
                'products.price',
                'products.brand',
                'products.image',
                'products.created_at',
                'products.updated_at'
            )
            ->orderByDesc('total_sold')
            ->take($limit)
            ->get();

        return $topProducts->isNotEmpty() ? $topProducts : self::take(3)->get();
    }

    public static function extractProductNames(string $recommendationText): array
    {
        preg_match_all('/\b[A-Za-z0-9\s\-]+\b/', $recommendationText, $matches);

        return $matches[0];
    }
}
