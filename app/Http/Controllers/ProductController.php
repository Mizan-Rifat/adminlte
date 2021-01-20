<?php

namespace App\Http\Controllers;

// use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        Gate::authorize(get_gate_action('Product','browse'));

        $dataType = 'product';
        $data = Product::all();

        return view('admin.bread.index',compact(
            'data',
            'dataType'
        ));
    }

    public function store(Request $request)
    {
        Gate::authorize(get_gate_action('Product','create'));

        $product = Product::create($request->all());

        return redirect()->route('products.index')->with('message', 'Created Successfully!');
    }

    public function show(Product $product)
    {
        
        Gate::authorize(get_gate_action('Product','show'));

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

        $dataType = 'product';
        $data = $product;

        return view('admin.bread.add-edit',compact(
            'data',
            'dataType'
        ));
    }

    public function create()
    {
        
        Gate::authorize(get_gate_action('Product','create'));

        $dataType = 'product';
        $data = null;

        return view('admin.bread.add-edit',compact(
            'data',
            'dataType'
        ));
    }

    public function update(Request $request,Product $product)
    {
        
        Gate::authorize(get_gate_action('Product','update'));

        $product->update($request->all());

        return redirect()->back()->with('message', 'Updated Successfully!');
    }

    public function destroy(Product $product)
    {
        
        Gate::authorize(get_gate_action('Product','destroy'));

        $product->delete();

        return redirect()->route('products.index')->with('message', 'Deleted Successfully!');

    }


    public function bulkDestroy(Request $request){

        Gate::authorize(get_gate_action('Product','destroy'));

        Product::destroy($request->ids);
        return redirect()->route('products.index')->with('message', 'Deleted Successfully!');
    }
}