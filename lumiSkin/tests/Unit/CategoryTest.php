<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Http\Request;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_category_can_be_created()
    {
        $category = Category::create([
            'name' => 'Test Category',
            'description' => 'Test Description'
        ]);

        $this->assertInstanceOf(Category::class, $category);
        $this->assertEquals('Test Category', $category->getName());
        $this->assertEquals('Test Description', $category->getDescription());
    }

    public function test_category_validation()
    {
        $request = new Request([
            'name' => 'Test Category',
            'description' => 'Test Description'
        ]);

        Category::validate($request);
        $this->assertTrue(true); // Si llegamos aquí, la validación pasó
    }

    public function test_category_products_relationship()
    {
        $category = Category::create([
            'name' => 'Test Category',
            'description' => 'Test Description'
        ]);

        $product = Product::create([
            'name' => 'Test Product',
            'description' => 'Test Description',
            'brand' => 'Test Brand',
            'price' => 100,
            'image' => 'default.jpg',
        ]);

        $category->products()->attach($product->id);
        
        $this->assertCount(1, $category->products);
        $this->assertInstanceOf(Product::class, $category->getProducts()->first());
    }

    public function test_description_limitation()
    {
        $longDescription = str_repeat('a', 100);
        $category = Category::create([
            'name' => 'Test Category',
            'description' => $longDescription
        ]);

        $this->assertEquals(93, strlen($category->getDescription()));
    }
} 