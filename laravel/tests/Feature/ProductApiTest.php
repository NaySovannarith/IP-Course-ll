<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;

class ProductApiTest extends TestCase
{

    public function test_can_get_product_by_valid_id()
{
    $product = \App\Models\Product::factory()->create();

    $response = $this->getJson("/api/products/{$product->id}");

    $response->assertStatus(200)
             ->assertJsonFragment([
                 'id' => $product->id,
             ]);
}

    
    public function test_get_product_by_invalid_id_returns_404()
    {
        $response = $this->getJson('/api/products/9999');

        $response->assertStatus(404);
    }
    public function test_create_product()
    {
        $category = \App\Models\Category::factory()->create();

        $response = $this->postJson('/api/products', [
            'name' => 'New Product',
            'description' => 'A test product',
            'category_id' => $category->id,
            'pricing' => 49.99,
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('products', ['name' => 'New Product']);

    }
    public function test_delete_product()
    {

        $product = Product::factory()->create();
        $response = $this->deleteJson("/api/products/{$product->id}");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }

    
    
    public function test_can_search_products_by_keyword()
    {
        Product::factory()->create(['name' => 'iPhone']);
        Product::factory()->create(['name' => 'Samsung']);

        $response = $this->getJson('/api/products?search=iphone');

        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => 'iPhone']);
    }

}
