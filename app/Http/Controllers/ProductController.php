<?php

namespace App\Http\Controllers;

use App\Events\ProductDeleted;
use App\Events\ProductUpdated;
use App\Http\Requests\ProductRequest;
use App\Models\AddableItem;
use App\Models\Category;
use App\Models\Ingredient;
use App\Models\NutritionalItem;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {

        Gate::authorize(get_gate_action('Product','browse'));

        $dataType = 'product';
        $data = Product::with('category','ingredients','addableItems')->get();

        return view('admin.bread.index',compact(
            'data',
            'dataType'
        ));
    }

    public function store(ProductRequest $request)
    {
        Gate::authorize(get_gate_action('Product','create'));

        $validatedData = $request->validated();

        $product = Product::create($validatedData);

        ProductUpdated::dispatch($product,$validatedData);
        
        return redirect()->route('nutritionalvalues.edit',['product'=>$product->id]);

    }

    public function show(Product $product)
    {
        Gate::authorize(get_gate_action('Product','show'));

        $product->load('category','ingredients','addableItems');

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

        $product->load('category','ingredients','addableItems');
        
        $dataType = 'product';
        $data = $product;
    
        $categories = Category::get(['id','name']);
        $ingredients = Ingredient::get(['id','name']);
        $addableItems = AddableItem::get(['id','name']);
  
        return view('admin.bread.add-edit',compact(
            'data',
            'dataType',
            'categories',
            'ingredients',
            'addableItems',
        ));
    }

    public function create()
    {
        Gate::authorize(get_gate_action('Product','create'));

        $dataType='product';
        $categories = Category::get(['id','name']);
        $ingredients = Ingredient::get(['id','name']);
        $addableItems = AddableItem::get(['id','name']);

        return view('admin.bread.add-edit',compact(
            'dataType',
            'categories',
            'ingredients',
            'addableItems',
        ));
    }

    public function update(ProductRequest $request,Product $product)
    {

        Gate::authorize(get_gate_action('Product','update'));

        $validatedData = $request->validated();

        $prevImage = $product->image;

        $product->update($validatedData);

        ProductUpdated::dispatch($product,$validatedData,$prevImage);

        return redirect()->route('nutritionalvalues.edit',['product'=>$product->id]);
        
    }

    public function destroy(Product $product)
    {
        Gate::authorize(get_gate_action('Product','destroy'));

        $product->delete();

        ProductDeleted::dispatch($product);

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

        $products = Product::whereIn('id',$request->ids)->get();

        Product::destroy($request->ids);

        ProductDeleted::dispatch($products);

        return redirect()->route('products.index')->with('message', 'Deleted Successfully!');
    }


}