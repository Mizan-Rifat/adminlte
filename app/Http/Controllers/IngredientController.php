<?php

namespace App\Http\Controllers;

// use App\Http\Requests\IngredientRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Ingredient;

class IngredientController extends Controller
{
    public function index()
    {
        Gate::authorize(get_gate_action('Ingredient','browse'));

        $dataType = 'ingredient';
        $data = Ingredient::all();

        return view('admin.bread.index',compact(
            'data',
            'dataType'
        ));
    }

    public function store(Request $request)
    {
        Gate::authorize(get_gate_action('Ingredient','create'));

        $ingredient = Ingredient::create($request->all());

        return redirect()->route('ingredients.index')->with('message', 'Created Successfully!');
    }

    public function show(Ingredient $ingredient)
    {
        
        Gate::authorize(get_gate_action('Ingredient','show'));

        $dataType = 'ingredient';
        $data = $ingredient;

        return view('admin.bread.show',compact(
            'data',
            'dataType'
        ));

    }
    
    public function edit(Ingredient $ingredient)
    {
        Gate::authorize(get_gate_action('Ingredient','update'));

        $dataType = 'ingredient';
        $data = $ingredient;

        return view('admin.bread.add-edit',compact(
            'data',
            'dataType'
        ));
    }

    public function create()
    {
        
        Gate::authorize(get_gate_action('Ingredient','create'));

        $dataType = 'ingredient';
        $data = null;

        return view('admin.bread.add-edit',compact(
            'data',
            'dataType'
        ));
    }

    public function update(Request $request,Ingredient $ingredient)
    {
        
        Gate::authorize(get_gate_action('Ingredient','update'));

        $ingredient->update($request->all());

        return redirect()->back()->with('message', 'Updated Successfully!');
    }

    public function destroy(Ingredient $ingredient)
    {
        
        Gate::authorize(get_gate_action('Ingredient','destroy'));

        $ingredient->delete();

        return redirect()->route('ingredients.index')->with('message', 'Deleted Successfully!');

    }


    public function bulkDestroy(Request $request){

        Gate::authorize(get_gate_action('Ingredient','destroy'));

        Ingredient::destroy($request->ids);
        return redirect()->route('ingredients.index')->with('message', 'Deleted Successfully!');
    }
}