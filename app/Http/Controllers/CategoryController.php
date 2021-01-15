<?php

namespace App\Http\Controllers;

// use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        Gate::authorize(get_gate_action('Category','browse'));

        $dataType = 'category';
        $data = Category::all();

        return view('admin.bread.index',compact(
            'data',
            'dataType'
        ));
    }

    public function store(Request $request)
    {
        Gate::authorize(get_gate_action('Category','create'));

        $category = Category::create($request->all());

        return redirect()->route('categories.index')->with('message', 'Created Successfully!');
    }

    public function show(Category $category)
    {
        
        Gate::authorize(get_gate_action('Category','show'));

        $dataType = 'category';
        $data = $category;

        return view('admin.bread.show',compact(
            'data',
            'dataType'
        ));

    }
    
    public function edit(Category $category)
    {
        Gate::authorize(get_gate_action('Category','update'));

        $dataType = 'category';
        $data = $category;

        return view('admin.bread.add-edit',compact(
            'data',
            'dataType'
        ));
    }

    public function create()
    {
        
        Gate::authorize(get_gate_action('Category','create'));

        $dataType = 'category';
        $data = null;

        return view('admin.bread.add-edit',compact(
            'data',
            'dataType'
        ));
    }

    public function update(Request $request,Category $category)
    {
        
        Gate::authorize(get_gate_action('Category','update'));

        $category->update($request->all());

        return redirect()->back()->with('message', 'Updated Successfully!');
    }

    public function destroy(Category $category)
    {
        
        Gate::authorize(get_gate_action('Category','destroy'));

        $category->delete();

        return redirect()->route('categories.index')->with('message', 'Deleted Successfully!');

    }


    public function bulkDestroy(Request $request){

        Gate::authorize(get_gate_action('Category','destroy'));

        Category::destroy($request->ids);
        return redirect()->route('categories.index')->with('message', 'Deleted Successfully!');
    }
}