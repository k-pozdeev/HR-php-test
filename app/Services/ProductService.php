<?php

namespace App\Services;

use App\Product;

class ProductService
{
    /**
     * @param int $page
     * @return array [Product[], Paginator]
     */
    public function getProducts(int $page = 1): array {
        $query = Product::query()
            ->select(['products.*', 'vendors.name AS vendor_name'])
            ->join('vendors', 'products.vendor_id', '=', 'vendors.id')
            ->orderByRaw("CAST(SUBSTRING(products.name, 9) AS UNSIGNED) ASC");
        $paginator = $query->paginate(25, ['*'], 'page', $page);
        $products = $query->get();
        return [$products, $paginator];
    }
}