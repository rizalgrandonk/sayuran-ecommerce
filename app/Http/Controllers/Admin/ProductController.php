<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Http\Controllers\CloudinaryStorage;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.product.index', [
            'title' => 'Products',
            'products' => Product::with('category')->orderBy('name')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.create', [
            'title' => 'Add Products',
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "name" => "required|max:50",
            "slug" => "required|unique:products",
            "category_id" => "required",
            "detail" => "required",
            'price' => 'required|numeric',
            "image" => "image|file|max:1024"
        ]);

        if ($request->file("image")) {
            $image  = $request->file('image');
            $result = CloudinaryStorage::upload($image->getRealPath(), $image->getClientOriginalName());
            $validatedData["image"] = $result;
        }

        Product::create($validatedData);

        return redirect()->route('admin.product.index')->with("success", "Success Adding Product");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('admin.product.edit', [
            'title' => 'Edit Products',
            'product' => $product,
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $rules = [
            "name" => "required|max:50",
            "category_id" => "required",
            "detail" => "required",
            'price' => 'required|numeric',
            "image" => "image|file|max:1024"
        ];

        if ($request->slug != $product->slug) {
            $rules["slug"] = "required|unique:products";
        }

        $validatedData = $request->validate($rules);

        if ($request->file("image")) {
            if ($request->oldImage) {
                $file   = $request->file('image');
                $result = CloudinaryStorage::replace($product->image, $file->getRealPath(), $file->getClientOriginalName());
                $validatedData["image"] = $result;
            } else {
                $image  = $request->file('image');
                $result = CloudinaryStorage::upload($image->getRealPath(), $image->getClientOriginalName());
                $validatedData["image"] = $result;
            }
        }

        Product::where("id", $product->id)->update($validatedData);

        return redirect()->route('admin.product.index')->with("success", "Success Updating Product");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if ($product->image) {
            CloudinaryStorage::delete($product->image);
        }

        Product::destroy($product->id);

        return redirect()->route('admin.product.index')->with("success", "Success Deleting Product");
    }

    public function createSlug(Request $request)
    {
        $slug = SlugService::createSlug(Product::class, 'slug', $request->from);
        return response()->json(["slug" => $slug]);
    }
}
