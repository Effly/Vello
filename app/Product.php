<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    public function category(){
        return $this->belongsTo('ProductCategory','parent_id')->get();
    }

    public function getProductWithCats($cat_id){
        return $this->where('parent_id',$cat_id)->get();
    }

}
