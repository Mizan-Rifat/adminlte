<?php

namespace App\Http\Controllers;

use App\Http\Requests\NutritionalItemRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\NutritionalItem;

class NutritionalItemController extends Controller
{
    public function index()
    {
        Gate::authorize(get_gate_action('NutritionalItem','browse'));

        $dataType = 'nutritionalItem';
        $data = NutritionalItem::all();

        return view('admin.bread.index',compact(
            'data',
            'dataType'
        ));
    }

    public function store(NutritionalItemRequest $request)
    {
        Gate::authorize(get_gate_action('NutritionalItem','create'));

        $validatedData = $request->validated();

        $nutritionalItem = NutritionalItem::create($validatedData);

        return redirect()->route('nutritionalitems.index')->with('message', 'Created Successfully!');
    }

    public function show(NutritionalItem $nutritionalItem)
    {
        
        Gate::authorize(get_gate_action('NutritionalItem','show'));

        $dataType = 'nutritionalItem';
        $data = $nutritionalItem;

        return view('admin.bread.show',compact(
            'data',
            'dataType'
        ));

    }
    
    public function edit(NutritionalItem $nutritionalItem)
    {
        Gate::authorize(get_gate_action('NutritionalItem','update'));

        $dataType = 'nutritionalItem';
        $data = $nutritionalItem;

        return view('admin.bread.add-edit',compact(
            'data',
            'dataType'
        ));
    }

    public function create()
    {
        
        Gate::authorize(get_gate_action('NutritionalItem','create'));

        $dataType = 'nutritionalItem';
        $data = null;

        return view('admin.bread.add-edit',compact(
            'data',
            'dataType'
        ));
    }

    public function update(NutritionalItemRequest $request,NutritionalItem $nutritionalItem)
    {
        
        Gate::authorize(get_gate_action('NutritionalItem','update'));

        $validatedData = $request->validated();

        $nutritionalItem->update($validatedData);

        return redirect()->back()->with('message', 'Updated Successfully!');
    }

    public function destroy(NutritionalItem $nutritionalItem)
    {
        
        Gate::authorize(get_gate_action('NutritionalItem','destroy'));

        $nutritionalItem->delete();

        return redirect()->route('nutritionalitems.index')->with('message', 'Deleted Successfully!');

    }


    public function bulkDestroy(Request $request){

        Gate::authorize(get_gate_action('NutritionalItem','destroy'));

        NutritionalItem::destroy($request->ids);
        return redirect()->route('nutritionalitems.index')->with('message', 'Deleted Successfully!');
    }
}