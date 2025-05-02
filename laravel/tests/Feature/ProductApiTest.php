<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;

class ProductApiTest extends TestCase
{
    
    /**
    * Test Case ID: Products-001
    * Description: Fetch product details by valid ID
    * Precondition: Product exists in the database
    * Test Steps:
    *   1. Send GET request to /api/products/{id}
    *   2. Check response status and structure
    * Test Data: Product ID = 1
    * Expected Result: Response is 200 with product details
    * Actual Result: Product details returned
    * Status: Passed
    * Remark: None
    */
    public function test_can_get_product_by_valid_id()
{
    $product = \App\Models\Product::factory()->create();

    $response = $this->getJson("/api/products/{$product->id}");

    $response->assertStatus(200)
             ->assertJsonFragment([
                 'id' => $product->id,
             ]);
}

    /**
    * Test Case ID: Products-002
    * Description: Fetch product details by invalid ID
    * Precondition: Product ID does not exist
    * Test Steps:
    *   1. Send GET request to /api/products/9999
    *   2. Check for 404 response
    * Test Data: Product ID = 9999
    * Expected Result: 404 Not Found
    * Actual Result: 404 returned
    * Status: Passed
    * Remark: None
    */
    public function test_get_product_by_invalid_id_returns_404()
    {
        $response = $this->getJson('/api/products/9999');

        $response->assertStatus(404);
    }

    /**
    * Test Case ID: TC003
    * Description: Create new product with valid data
    * Precondition: Admin must be authenticated
    * Test Steps:
    *   1. Send POST request to /api/products
    *   2. Provide valid name, price, description
    * Test Data: Name: Test Product, Price: 9.99
    * Expected Result: Product created, 201 status
    * Actual Result: Product created
    * Status: Passed
    * Remark: None
    */
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
    /**
    * Test Case ID: TC009
    * Description: Test deleting a product
    * Precondition: A product exists in the database
    * Test Steps:
    *   1. Create a product
    *   2. Send DELETE request to /api/products/{id}
    * Test Data: Product ID (auto-generated)
    * Expected Result: HTTP 200 OK / Product deleted from database
    * Actual Result: HTTP 200 OK / Product deleted from database
    * Status: Passed
    * Remark: Product deletion is functioning correctly
    */
    public function test_delete_product()
    {

        $product = Product::factory()->create();
        $response = $this->deleteJson("/api/products/{$product->id}");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }

    /**
    * Test Case ID: TC010
    * Description: Test searching products by keyword
    * Precondition: Products with names "iPhone" and "Samsung" exist
    * Test Steps:
    *   1. Create two products with names "iPhone" and "Samsung"
    *   2. Send GET request to /api/products?search=iphone
    * Test Data: search=iphone
    * Expected Result: HTTP 200 OK / Response contains product with name "iPhone"
    * Actual Result: HTTP 200 OK / Response contains product with name "iPhone"
    * Status: Passed
    * Remark: Search functionality is working and is case-insensitive
    */
    
    public function test_can_search_products_by_keyword()
    {
        Product::factory()->create(['name' => 'iPhone']);
        Product::factory()->create(['name' => 'Samsung']);

        $response = $this->getJson('/api/products?search=iphone');

        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => 'iPhone']);
    }

}
