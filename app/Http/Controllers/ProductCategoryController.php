<?php

namespace App\Http\Controllers;

use App\Categories;
use App\ProductCategory;
use App\Product;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function catalog(ProductCategory $productCategory)
    {
        $rootCategories = $productCategory->rootCategories();
        return view('catalog', ['rootCategories' => $rootCategories,]);
    }


    public function getCatThirdProducts(Product $productCategories,$categorySlug,$subcategorySlug, $thirdcategorySlug)
    {

        $products = $productCategories->where('cat_slug', $thirdcategorySlug)->get();
        return view('products', ['products' => $products]);

    }

    public function getCatSubProduct(Product $productCategories,ProductCategory $productCategory,$categorySlug,$subcategorySlug){
        $products = $productCategories->where('cat_slug', $subcategorySlug)->get();
        if($products->count()) {
            return view('products', ['products' => $products]);
        }else{
            $rootCategories = $productCategory->subCategories($subcategorySlug);
            dump($rootCategories);
            return view('categories', ['rootCategories' => $rootCategories,]);
        }
    }

    public function getCatProduct(Product $productCategories,$categorySlug){
        $products = $productCategories->where('cat_slug', $categorySlug)->get();
        return view('products', ['products' => $products]);
    }



}
