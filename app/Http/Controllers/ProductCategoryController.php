<?php

namespace App\Http\Controllers;

use App\Categories;
use App\ProductCategory;
use App\Product;
use App\Property;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function catalog(ProductCategory $productCategory)
    {
        $rootCategories = $productCategory->rootCategories();
        return view('catalog', ['rootCategories' => $rootCategories,]);
    }


    public function getCatThirdProducts(Product $productCategories, $categorySlug, $subcategorySlug, $thirdcategorySlug, Request $request, Property $property)
    {
        $products = $productCategories->getCatProducts($thirdcategorySlug);
        $properties = $property->getBrands($thirdcategorySlug);

        foreach ($properties as $property){

            if ($request->has($property->brand)){
                $products = $products->where('brand',$property->brand);

            }

        }
        if ($request->price_from) {
            $products = $products->where('cost', '>=', $request->price_from);
        }
        if ($request->price_to) {
            $products = $products->where('cost', '<=', $request->price_to);

        }


        return view('products', ['products' => $products->get(), 'properties' => $properties]);
    }

    public function getCatSubProduct(Product $productCategories, ProductCategory $productCategory, $categorySlug, $subcategorySlug, Request $request)
    {

        $products = $productCategories->getCatProducts($subcategorySlug);
        if ($products->count() > 0) {
            if ($request->price_from && $request->price_to) {
                $products = $products->where('cost', '>=', $request->price_from)->where('cost', '<=', $request->price_to)->get();
                return view('products', ['products' => $products]);
            } elseif ($request->price_to) {
                $products = $products->where('cost', '<=', $request->price_to)->get();
                return view('products', ['products' => $products]);
            } elseif ($request->price_from) {
                $products = $products->where('cost', '>=', $request->price_from)->get();

                return view('products', ['products' => $products]);
            } else {
                $products = $productCategories->getCatProducts($subcategorySlug)->get();
                return view('products', ['products' => $products]);
            }
//            return view('products', ['products' => $products]);
        } else {
            $rootCategories = $productCategory->subCategories($subcategorySlug);

            return view('categories', ['rootCategories' => $rootCategories,]);
        }
    }

    public function getCatProduct(Product $productCategories, $categorySlug, Request $request)
    {
        $products = $productCategories->getCatProducts($categorySlug);
        if ($request->price_from && $request->price_to) {
            $products = $products->where('cost', '>=', $request->price_from)->where('cost', '<=', $request->price_to)->get();
            return view('products', ['products' => $products]);
        } elseif ($request->price_to) {
            $products = $products->where('cost', '<=', $request->price_to)->get();
            return view('products', ['products' => $products]);
        } elseif ($request->price_from) {
            $products = $products->where('cost', '>=', $request->price_from)->get();

            return view('products', ['products' => $products]);
        } else {
            $products = $productCategories->getCatProducts($categorySlug)->get();
            return view('products', ['products' => $products]);
        }
//        return view('products', ['products' => $products]);
    }

    public function getProduct($product_slug, Product $productCategories)
    {

        $product = $productCategories->getProduct($product_slug);
        return view('product', ['product' => $product]);
    }


}
