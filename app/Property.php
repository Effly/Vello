<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    public function category(){
        return $this->belongsTo($this,'cat_slug');
    }
    public function getBrands($cat_slug){
        return $this->where('cat_slug', $cat_slug)->with('category')->get();
    }

    public function getFilteredProduct($cat_slug,$request){

        return $this->where('cat_slug', $cat_slug)->where('brand',$request);
//            ->where(function ($query) use ($request){
//            $query->where(function ($q) use ($request){
//
//            });
//        });
    }
//запрос УсловиеКатегория и УсловиеБренд и ((УсловиеЦеныОт или УсловиеЦеныДо)или (УсловиеЦеныОт и УсловиеЦеныДо))

}
