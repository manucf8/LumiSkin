<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Collection;

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
     *   $this->categories - Category[] - contains the associated categories
     *   $this->wishLists - WishList[] - contains the associated wish List
     *   $this->items - Item[] - contains the associated item
     *   $this->skincareTests - SkincareTest[] - contains the associated Skincare Test
     */

    protected $fillable = ['name', 'description', 'image', 'brand', 'price'];

    public static function validate($request): void
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
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

    // Relationship wish List
    public function getWishLists(): Collection
    {
        return $this->wishLists;
    }

    public function setWishLists(Collection $wishLists): void
    {
        $this->wishLists = $wishLists;
    }

    // public function wishLists(): HasMany
    // {
    //     return $this->hasMany(WishList::class);
    // }

    // Relationship categories
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function setCategories(Collection $categories): void
    {
        $this->categories = $categories;
    }

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }

    // Relationship Items
    public function getItems(): Collection
    {
        return $this->items;
    }

    public function setItems(Collection $items): void
    {
        $this->items = $items;
    }

    // public function items(): HasMany
    // {
    //     return $this->hasMany(Item::class);
    // }

    // Relationship skincare test
    public function getSkincareTests(): Collection
    {
        return $this->skincareTests;
    }

    public function setSkincareTests(Collection $skincareTests): void
    {
        $this->skincareTests = $skincareTests;
    }

    // public function skincareTests(): HasMany
    // {
    //     return $this->hasMany(SkincareTest::class);
    // }


}
