<?PHP
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    // Get all products - GET /api/products
    public function getProducts(): JsonResponse
    {
        $products = Product::all();
        return response()->json([
            "success" => true,
            "message" => "Getting list of products",
            "data" => $products
        ], 200);
    }

    // Create a new product - POST /api/products
    public function createProduct(Request $request): JsonResponse
    {

        // $validated = $request->validate([
        //     'name' => 'required|string|max:255',
        //     'pricing' => 'required|numeric|min:0',
        //     'category_id' => 'required|exists:categories,id'
        // ]);
        // dd("Hello");
        $product = Product::create($request->all());

        return response()->json([
            "success" => true,
            "message" => "Creating a new product",
            "data" => $product
        ], 201);
    }

    // Get a specific product - GET /api/products/{productId}
    public function getProduct($productId): JsonResponse
    {
        $product = Product::find($productId);

        if (!$product) {
            return response()->json([
                "success" => false,
                "message" => "Product not found"
            ], 404);
        }

        return response()->json([
            "success" => true,
            "message" => "Getting product based on given productId",
            "data" => $product
        ], 200);
    }

    // Update a product - PATCH /api/products/{productId}
    public function updateProduct(Request $request, $productId): JsonResponse
    {
        $product = Product::find($productId);

        if (!$product) {
            return response()->json([
                "success" => false,
                "message" => "Product not found"
            ], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'price' => 'sometimes|numeric|min:0',
            'category_id' => 'sometimes|exists:categories,id'
        ]);

        $product->update($validated);

        return response()->json([
            "success" => true,
            "message" => "Updating product based on given productId",
            "data" => $product
        ], 200);
    }

    // Delete a product - DELETE /api/products/{productId}
    public function deleteProduct($productId): JsonResponse
    {
        $product = Product::find($productId);

        if (!$product) {
            return response()->json([
                "success" => false,
                "message" => "Product not found"
            ], 404);
        }

        $product->delete();

        return response()->json([
            "success" => true,
            "message" => "Deleting product based on given productId"
        ], 200);
    }
}