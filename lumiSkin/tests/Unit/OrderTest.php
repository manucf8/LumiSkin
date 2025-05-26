<?php

namespace Tests\Unit;

use App\Models\Order;
use App\Models\User;
use App\Models\Item;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Http\Request;
use Carbon\Carbon;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    public function test_order_can_be_created()
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'balance' => 0,
        ]);

        $order = Order::create([
            'user_id' => $user->id,
            'total' => 1000,
            'delivery_date' => Carbon::tomorrow(),
        ]);

        $this->assertInstanceOf(Order::class, $order);
        $this->assertEquals(1000, $order->getTotal());
        $this->assertEquals($user->id, $order->getUserId());
    }

    public function test_order_validation()
    {
        $request = new Request([
            'delivery_date' => Carbon::tomorrow()->toDateString(),
        ]);

        Order::validate($request);
        $this->assertTrue(true); // Si llegamos aquí, la validación pasó
    }

    public function test_order_user_relationship()
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'balance' => 0,
        ]);

        $order = Order::create([
            'user_id' => $user->id,
            'total' => 1000,
            'delivery_date' => Carbon::tomorrow(),
        ]);

        $this->assertInstanceOf(User::class, $order->user);
        $this->assertEquals('Test User', $order->getCustomerName());
    }

    public function test_order_items_relationship()
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'balance' => 0,
        ]);

        $order = Order::create([
            'user_id' => $user->id,
            'total' => 1000,
            'delivery_date' => Carbon::tomorrow(),
        ]);

        $product = Product::create([
            'name' => 'Test Product',
            'description' => 'Test Description',
            'brand' => 'Test Brand',
            'price' => 500,
            'image' => 'default.jpg',
        ]);

        $item = Item::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => 2,
            'price' => 500,
            'subtotal' => 1000,
        ]);

        $this->assertCount(1, $order->items);
        $this->assertInstanceOf(Item::class, $order->getItems()->first());
    }

    public function test_delivery_date_formatting()
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'balance' => 0,
        ]);

        $tomorrow = Carbon::tomorrow();
        $order = Order::create([
            'user_id' => $user->id,
            'total' => 1000,
            'delivery_date' => $tomorrow,
        ]);

        $this->assertEquals($tomorrow->format('M d, Y'), $order->getDeliveryDate());
    }
} 