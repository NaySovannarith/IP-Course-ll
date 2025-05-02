<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
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

/**
* Test Case ID: TC004
* Description: Test getting all categories
* Precondition: At least 5 categories exist in the database.
* Test Steps:
*   1. Send GET request to /api/categories
* Test Data: None
* Expected Result: HTTP 200 OK / JSON array with 5 category objects
* Actual Result: HTTP 200 OK / JSON array with 5 category objects
* Status: Passed
* Remark: None
*/

/**
* Test Case ID: TC005
* Description: Test getting a category by ID
* Precondition: A category exists in the database.
* Test Steps:
*   1. Create a category
*   2. Send GET request to /api/categories/{id}
* Test Data: Category ID (auto-generated), Name: "Books"
* Expected Result: HTTP 200 OK / JSON object containing the category details
* Actual Result: HTTP 200 OK / JSON object containing the category details
* Status: Passed
* Remark: None
*/

/**
* Test Case ID: TC006
* Description: Test that an admin can create a category
* Precondition: A user exists with admin privileges.
* Test Steps:
*   1. Create an admin user
*   2. Authenticate as the admin
*   3. Send POST request to /api/categories with category name
* Test Data: Name: "Electronics"
* Expected Result: HTTP 201 Created / Category stored in database
* Actual Result: HTTP 201 Created / Category stored in database
* Status: Passed
* Remark: None
*/
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

/**
* Test Case ID: TC008
* Description: Test category creation fails when the name field is empty
* Precondition: The API requires a non-empty name field for category creation
* Test Steps:
*   1. Send POST request to /api/categories with an empty name
* Test Data: name: ""
* Expected Result: HTTP 422 Unprocessable Entity / Validation error on 'name'
* Actual Result: HTTP 422 Unprocessable Entity / Validation error on 'name'
* Status: Passed
* Remark: Validation is correctly enforced on the 'name' field
*/

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

}
