<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'title','code','brand','cost','model','slug','desc','cat_slug'
    ];

    public function category(){
        return $this->belongsTo($this,'cat_slug')->get();
    }



    public function getCatProducts($cat_slug){

        return $this->where('cat_slug', $cat_slug);
    }


    public function getPriceForCount(){

            return $this->pivot->count *  $this->cost;


    }
    public function getProduct($product_slug){
        return $this->where('slug',$product_slug)->get();
    }

    public function getFilteredProduct($cat_slug,$request){

        return $this->where('cat_slug', $cat_slug)->where('brand',$request);
//            ->where(function ($query) use ($request){
//            $query->where(function ($q) use ($request){
//
//            });
//        });
    }
}
