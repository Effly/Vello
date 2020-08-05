<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Product;
use App\ProductCategory;
use App\Share;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ShareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(30);

        return view('admin.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rootCategories = ProductCategory::get();
        $subCategories = ProductCategory::where('parent_id', )->with('ProductCategory')->get();
        $thirdCategories = ProductCategory::where('parent_id', )->with('ProductCategory')->get();

        return view('admin.create', ['rootCategories' => $rootCategories,]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'cost' => 'required|numeric',
            'code' => 'required',
            'brand' => 'required',
            'model' => 'required',
            'desc' => 'required',
        ]);

        $product = new Product([
        'cat_slug' => $request->get('category'),
        'title' => $request->get('title'),
        'code' => $request->get('code'),
        'brand' => $request->get('brand'),
        'cost' => $request->get('cost'),
        'model' => $request->get('model'),
        'slug' => Str::slug($request->get('title'),'-'),
        'desc' => $request->get('desc'),
        ]);

        $product->save();
        return redirect('admin/shares')->with('success', 'Stock has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param ProductCategory $productCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ProductCategory $productCategory)
    {
        $rootCategories = $productCategory->rootCategories();
        return view('admin.create', ['rootCategories' => $rootCategories,]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);

        return view('admin.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'cost' => 'required|numeric',
            'code' => 'nullable',
            'brand' => 'nullable',
            'model' => 'nullable',
            'desc' => 'nullable',
        ]);

        $product = Product::find($id);
        $product->title = $request->get('title');
        $product->cost = $request->get('cost');
        $product->code = $request->get('code');
        $product->brand = $request->get('brand');
        $product->model = $request->get('model');
        $product->desc = $request->get('desc');
        $product->save();

        return redirect('/shares')->with('success', 'Stock has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect('/shares')->with('success', 'Stock has been deleted Successfully');
    }
}
