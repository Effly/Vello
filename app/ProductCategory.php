<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $table = 'categories';

    public function ProductCategory(){
        return $this->hasMany($this, 'parent_id');
    }
    public function rootCategories(){
        return $this->where('parent_id', 0)->with('ProductCategory')->get();
    }



    public function getThirdCatProducts($thirdcategorySlug){
        return $this->where('cat_slug', $thirdcategorySlug)->get();
    }


    public function subCategories($slug){
        return $this->where('slug', $slug)->first();
    }
    public function getChildCats($id){
        return $this->where('parent_id', $id)->with('ProductCategory')->get();
    }

    public function products(){
        return $this->hasMany($this,'cat_slug');
    }
    public function brands(){
        return $this->hasMany($this,'cat_slug');
    }

    public function getBrands($cat_slug){
        return $this->where('cat_slug', $cat_slug)->with('brands')->get();
    }
}
