<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Catalog;
class CategoryController extends Controller
{
    public function allData(){
        dd(Catalog::all());
    }

}
