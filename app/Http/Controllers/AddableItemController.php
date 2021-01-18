<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddableItemRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\AddableItem;

class AddableItemController extends Controller
{
    public function index()
    {
        Gate::authorize(get_gate_action('AddableItem','browse'));

        $dataType = 'addableItem';
        $data = AddableItem::all();

        return view('admin.bread.index',compact(
            'data',
            'dataType'
        ));
    }

    public function store(AddableItemRequest $request)
    {
        Gate::authorize(get_gate_action('AddableItem','create'));

        $validatedData = $request->validated();

        $addableItem = AddableItem::create($validatedData);

        return redirect()->route('addableitems.index')->with('message', 'Created Successfully!');
    }

    public function show(AddableItem $addableItem)
    {
        
        Gate::authorize(get_gate_action('AddableItem','show'));

        $dataType = 'addableItem';
        $data = $addableItem;

        return view('admin.bread.show',compact(
            'data',
            'dataType'
        ));

    }
    
    public function edit(AddableItem $addableItem)
    {
        Gate::authorize(get_gate_action('AddableItem','update'));

        $dataType = 'addableItem';
        $data = $addableItem;

        return view('admin.bread.add-edit',compact(
            'data',
            'dataType'
        ));
    }

    public function create()
    {
        
        Gate::authorize(get_gate_action('AddableItem','create'));

        $dataType = 'addableItem';
        $data = null;

        return view('admin.bread.add-edit',compact(
            'data',
            'dataType'
        ));
    }

    public function update(AddableItemRequest $request,AddableItem $addableItem)
    {
        
        Gate::authorize(get_gate_action('AddableItem','update'));

        $validatedData = $request->validate();

        $addableItem->update($validatedData);

        return redirect()->back()->with('message', 'Updated Successfully!');
    }

    public function destroy(AddableItem $addableItem)
    {
        
        Gate::authorize(get_gate_action('AddableItem','destroy'));

        $addableItem->delete();

        return redirect()->route('addableitems.index')->with('message', 'Deleted Successfully!');

    }


    public function bulkDestroy(Request $request){

        Gate::authorize(get_gate_action('AddableItem','destroy'));

        AddableItem::destroy($request->ids);
        return redirect()->route('addableItems.index')->with('message', 'Deleted Successfully!');
    }

    public function removeImage(AddableItem $addableItem){
        
    }
}