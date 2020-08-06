<?php

namespace App\Http\Controllers;

use App\Categories;
use App\ProductCategory;
use App\Product;
use App\Property;
use Illuminate\Database\Eloquent\Collection;
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

        $properties = $property->getBrands($thirdcategorySlug);

        if (count($request->all()) >0) {
            $allFiltersProducts = new Collection();
            foreach ($properties as $property) {
                if ($request->has($property->brand)) {
                    $filter = $productCategories->getFilteredProduct($thirdcategorySlug, $property->brand);
                    if ($request->price_from) {
                        $filter = $filter->where('cost', '>=', $request->price_from);
                    }
                    if ($request->price_to) {
                        $filter = $filter->where('cost', '<=', $request->price_to);

                    }

                    $allFiltersProducts = $allFiltersProducts->merge($filter->get());

                }
            }
            return view('products', ['products' => $allFiltersProducts, 'properties' => $properties]);
        } else {
            $products = $productCategories->getCatProducts($thirdcategorySlug)->get();
            return view('products', ['products' => $products, 'properties' => $properties]);
        }


    }

    public function getCatSubProduct(Product $productCategories, ProductCategory $productCategory, $categorySlug, $subcategorySlug, Request $request, Property $property)
    {

        $products = $productCategories->getCatProducts($subcategorySlug);
        if ($products->count() > 0) {
            $products = $productCategories->getCatProducts($subcategorySlug);
            $properties = $property->getBrands($subcategorySlug);
            if ($request) {
                $allFiltersProducts = new Collection();
                foreach ($properties as $property) {
                    if ($request->has($property->brand)) {
                        $filter = $productCategories->getFilteredProduct($subcategorySlug, $property->brand);
                        if ($request->price_from) {
                            $filter = $filter->where('cost', '>=', $request->price_from);
                        }
                        if ($request->price_to) {
                            $filter = $filter->where('cost', '<=', $request->price_to);

                        }

                        $allFiltersProducts = $allFiltersProducts->merge($filter->get());

                    }
                }
                return view('products', ['products' => $allFiltersProducts, 'properties' => $properties]);
            } else {
                return view('products', ['products' => $products, 'properties' => $properties]);
            }
        } else {
            $rootCategories = $productCategory->subCategories($subcategorySlug);
            $childCats = $productCategory->getChildCats($rootCategories->id);

            return view('categories', ['rootCategories' => $childCats,]);
        }
    }

    public function getCatProduct(Product $productCategories, $categorySlug, Request $request, Property $property,ProductCategory $productCategory)
    {
        $products = $productCategories->getCatProducts($categorySlug);
        if ($products->count() > 0) {
            $products = $productCategories->getCatProducts($categorySlug);
            $properties = $property->getBrands($categorySlug);
            if ($request) {
                $allFiltersProducts = new Collection();
                foreach ($properties as $property) {
                    if ($request->has($property->brand)) {
                        $filter = $productCategories->getFilteredProduct($categorySlug, $property->brand);
                        if ($request->price_from) {
                            $filter = $filter->where('cost', '>=', $request->price_from);
                        }
                        if ($request->price_to) {
                            $filter = $filter->where('cost', '<=', $request->price_to);

                        }

                        $allFiltersProducts = $allFiltersProducts->merge($filter->get());

                    }
                }
                return view('products', ['products' => $allFiltersProducts, 'properties' => $properties]);
            } else {
                return view('products', ['products' => $products, 'properties' => $properties]);
            }
        } else {
            $rootCategories = $productCategory->subCategories($categorySlug);
            $childCats = $productCategory->getChildCats($rootCategories->id);

            return view('categories', ['rootCategories' => $childCats,]);
        }

    }

    public function getProduct($product_slug, Product $productCategories)
    {

        $product = $productCategories->getProduct($product_slug);
        return view('product', ['product' => $product]);
    }


}
