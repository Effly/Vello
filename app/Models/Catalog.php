<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    protected $table = 'categories';

    public function ProductCategory(){
        return $this->hasMany($this, 'parent_id');
    }

    public function rootCategories(){
        return $this->where('parent_id', 0)->with('ProductCategory')->get();

    }
}
