<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Category;


class CategoryApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_get_all_categories()
    {
        Category::factory()->count(5)->create();

        $response = $this->getJson('/api/categories');

        $response->assertStatus(200)
                 ->assertJsonCount(5,'data');
    }
   


    public function test_can_get_category_by_id()
    {
        $category = Category::factory()->create();

        $response = $this->getJson("/api/categories/{$category->id}");

        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => $category->name]);
    }
    /**
    * Test Case ID: TC006
    * Description: Test that an admin can create a category
    * Precondition: A user exists with admin privileges.
    * Test Steps:
    *   1. Send POST request to /api/categories with category name
    * Test Data: Name: "Electronics"
    * Expected Result: HTTP 201 Created / Category stored in database
    * Actual Result: HTTP 201 Created / Category stored in database
    * Status: Passed
    * Remark: None
    */

    public function test_create_category()
    {
        $response = $this->postJson('/api/categories', [
            'name' => 'Electronics',
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('categories', ['name' => 'Electronics']);
    }
    /**
    * Test Case ID: TC007
    * Description: Test delete a category
    * Precondition: A category exists in the database and the user can delete
    * Test Steps:
    *   1. Send DELETE request to /api/categories/{id}
    * Test Data: Category ID (auto-generated)
    * Expected Result: HTTP 200 OK / Category deleted from database
    * Actual Result: HTTP 200 OK / Category deleted from database
    * Status: Passed
    * Remark: Category deletion is functioning correctly
    */
    public function test_delete_category()
    {
        $category = Category::factory()->create();

        $response = $this->deleteJson("/api/categories/{$category->id}");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }

    public function test_create_category_fails_without_name()
    {

        $response = $this->postJson('/api/categories', [
            'name' => '',
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }

}
    