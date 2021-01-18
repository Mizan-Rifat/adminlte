<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddableItemRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\AddableItem;
use Illuminate\Support\Facades\Storage;

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

        $validatedData = $request->validated();

        if($request->hasFile('image')){
            $file = $request->file('image');
            $file->store('images/addableItems');
            $validatedData['image'] = "images/addableItems/".$file->hashName();

            if($addableItem->image != null){
                Storage::delete($addableItem->image);
            }
            
        }
        
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

        $request->validate([
            'ids'=>['required','array'],
            'ids.*'=>['numeric'],
        ],
        [
            'ids.*.numeric'=> 'The id must be numeric.'
        ]);

        AddableItem::destroy($request->ids);
        return redirect()->route('addableitems.index')->with('message', 'Deleted Successfully!');
    }
}