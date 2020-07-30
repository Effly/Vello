<?php

namespace App\Http\Controllers;

use App\ProductCategory;
use App\Product;
use Illuminate\Http\Request;
use App\Models\Catalog;

class CategoryController extends Controller
{
    public function allData(Product $productsModel)
    {

//            $catalogs = Catalog::where('parent_id', '=', 1)->get();
//            foreach ($catalogs as $catalog) {
//
//                dd($catalog->id,$catalog->name);
//
//            }
            $categories = ProductCategory::where('parent_id',31)->get();


//
            foreach ($categories as $category){
                $products = $productsModel->getProductWithCats($category->id);//запрос where  моделе Product
                foreach ($products as $product){
                    $items=[
                        'title' => $product->title,
                        'code' => $product->code,
                        'brand' => $product->brand,
                        'cost' => $product->cost,
                        'model' => $product->model,
                        'desc' => $product->desc,
                    ];
                    dump($items);
                }


            }
    }

}
