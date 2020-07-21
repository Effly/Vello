<?php

namespace App\Http\Controllers;

use App\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function index(ProductCategory $productCategory){
        $rootCategories = $productCategory->rootCategories();
        return view('catalog', ['rootCategories' => $rootCategories,]);
    }
}
