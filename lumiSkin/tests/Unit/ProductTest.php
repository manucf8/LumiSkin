<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Http\Request;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_product_can_be_created()
    {
        $product = Product::create([
            'name' => 'Test Product',
            'description' => 'Test Description',
            'brand' => 'Test Brand',
            'price' => 100,
            'image' => 'default.jpg',
        ]);

        $this->assertInstanceOf(Product::class, $product);
        $this->assertEquals('Test Product', $product->getName());
        $this->assertEquals('Test Description', $product->getDescription());
        $this->assertEquals('Test Brand', $product->getBrand());
        $this->assertEquals(100, $product->getPrice());
    }

    public function test_product_validation()
    {
        $category = Category::create([
            'name' => 'Test Category',
            'description' => 'Test Category Description',
        ]);
        $request = new Request([
            'name' => 'Test Product',
            'description' => 'Test Description',
            'brand' => 'Test Brand',
            'price' => 100,
            'categories' => [$category->id],
            'image' => 'default.jpg',
        ]);

        Product::validate($request);
        $this->assertTrue(true); // Si llegamos aquí, la validación pasó
    }

    public function test_product_categories_relationship()
    {
        $product = Product::create([
            'name' => 'Test Product',
            'description' => 'Test Description',
            'brand' => 'Test Brand',
            'price' => 100,
            'image' => 'default.jpg',
        ]);

        $category = Category::create([
            'name' => 'Test Category',
            'description' => 'Test Category Description'
        ]);

        $product->categories()->attach($category->id);
        
        $this->assertCount(1, $product->categories);
        $this->assertEquals('Test Category', $product->getCategories());
    }

    public function test_calculate_total()
    {
        $product = Product::create([
            'name' => 'Test Product',
            'description' => 'Test Description',
            'brand' => 'Test Brand',
            'price' => 100,
            'image' => 'default.jpg',
        ]);

        session(['cart' => [$product->id => 2]]);
        
        $total = Product::calculateTotal();
        $this->assertEquals(200, $total);
    }

    public function test_calculate_total_quantity()
    {
        $product = Product::create([
            'name' => 'Test Product',
            'description' => 'Test Description',
            'brand' => 'Test Brand',
            'price' => 100,
            'image' => 'default.jpg',
        ]);

        session(['cart' => [$product->id => 2]]);
        
        $quantity = Product::calculateTotalQuantity();
        $this->assertEquals(2, $quantity);
    }
} 