<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\AddableItem;
use App\Models\Category;
use App\Models\Ingredient;
use App\Models\NutritionalItem;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {

        Gate::authorize(get_gate_action('Product','browse'));

        $dataType = 'product';
        $data = Product::with('category')->get();

        return view('admin.bread.index',compact(
            'data',
            'dataType'
        ));
    }

    public function store(ProductRequest $request)
    {
        Gate::authorize(get_gate_action('Product','create'));

        $validatedData = $request->validated();

        if($request->hasFile('image')){
            $file = $request->file('image');
            $file->store('images/products');
            $validatedData['image'] = "images/products/".$file->hashName();
        }

        $product = Product::create($validatedData);


        return redirect()->route('products.index')->with('message', 'Created Successfully!');
    }

    public function show(Product $product)
    {
        Gate::authorize(get_gate_action('Product','show'));

        $product->load('category');

        $dataType = 'product';
        $data = $product;

        return view('admin.bread.show',compact(
            'data',
            'dataType'
        ));
    }
    
    public function edit(Product $product)
    {
        
        Gate::authorize(get_gate_action('Product','update'));

        $product->load('category');
        
        $dataType = 'product';
        $data = $product;
    
        $categories = Category::get(['id','name']);
  
        return view('admin.bread.add-edit',compact(
            'data',
            'dataType',
            'categories',
        ));
    }

    public function create()
    {
        Gate::authorize(get_gate_action('Product','create'));

        $dataType='product';
        $categories = Category::get(['id','name']);

        return view('admin.bread.add-edit',compact(
            'dataType',
            'categories',
        ));
    }

    public function update(ProductRequest $request,Product $product)
    {

        Gate::authorize(get_gate_action('Product','update'));

        $validatedData = $request->validated();

        if($request->hasFile('image')){
            $file = $request->file('image');
            $file->store('images/products');
            $validatedData['image'] = "images/products/".$file->hashName();

            if($product->image != null){
                Storage::delete($product->image);
            }
        }

        $product->update($validatedData);
        
        return redirect()->back()->with('message', 'Updated Successfully!');
    }

    public function destroy(Product $product)
    {
        Gate::authorize(get_gate_action('Product','destroy'));

        Storage::delete($product->image);

        $product->delete();

        return redirect()->route('products.index')->with('message', 'Deleted Successfully!');

    }


    public function bulkDestroy(Request $request){

        Gate::authorize(get_gate_action('Product','destroy'));

        $request->validate([
            'ids'=>['required','array'],
            'ids.*'=>['numeric'],
        ],
        [
            'ids.*.numeric'=> 'The id must be numeric.'
        ]);

        $images = Product::whereIn('id',$request->ids)->pluck('image');

        foreach ($images as $image) {
            Storage::delete($image);
        }

        Product::destroy($request->ids);

        return redirect()->route('products.index')->with('message', 'Deleted Successfully!');
    }

    public function removeImage(Product $product,Request $request){

        Gate::authorize(get_gate_action('Product','update'));

        $images = json_decode($product->image);

        if (($key = array_search($request->image, $images)) !== false) {
            unset($images[$key]);
        }


        $product->update([
            'image'=>json_encode(array_values($images)),
        ]);

        Storage::delete(str_replace("images/","",$request->image));

        return response()->json([
            'message' => 'Image removed successfully'
        ],200);
    }
}