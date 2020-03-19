<?php

namespace App\Http\Controllers;

use App\Http\Requests\PriceEditRequest;
use App\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function products(Request $request, ProductService $productService) {
        $page = $request->get('page', 1);
        list($products, $paginator) = $productService->getProducts($page);
        $data = [
            'title' => 'Продукты',
            'menu_active' => 'products',
            'products' => $products,
            'paginator' => $paginator,
        ];
        return view('productlist', $data);
    }

    public function editPrice(PriceEditRequest $request, $id) {
        /** @var Product $product */
        $product = Product::findOrFail($id);
        $newPrice = $request->get('price');
        $product->price = $newPrice;
        $product->save();
        return response()->json(['price' => $newPrice]);
    }
}
