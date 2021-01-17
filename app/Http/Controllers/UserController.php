<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $dataType = 'user';
        $data = User::with('roles')->get();

        return view('admin.bread.index',compact(
            'data',
            'dataType'
        ));
    }

    public function store(Request $request)
    {
        $user = User::create($request->all());

        return redirect()->route('users.index')->with('message', 'Created Successfully!');
    }

    public function show(User $user)
    {
        $dataType = 'user';
        $data = $user;

        // return $user;

        return view('admin.bread.show',compact(
            'data',
            'dataType'
        ));

    }
    
    public function edit(User $user)
    {
        $dataType = 'user';
        $data = $user;

        $roles = Role::all();

        return view('admin.bread.add-edit',compact(
            'data',
            'dataType',
            'roles',
        ));
    }

    public function create()
    {
        $dataType = 'user';
        $data = null;

        return view('admin.bread.add-edit',compact(
            'data',
            'dataType'
        ));
    }

    public function update(UserRequest $request,User $user)
    {

        $validatedData = $request->validated();
        unset($validatedData['old_password']);

        if(isset($validatedData['password']) && $validatedData['password'] != null){
            $validatedData['password'] = Hash::make($validatedData['password']);
        }else{
            unset($validatedData['password']);
        }

        $user->roles()->sync($validatedData['roles']);

        if(isset($validatedData['roles'])){
            unset($validatedData[' roles']);
        }
        
        $user->update($validatedData);

        return redirect()->back()->with('message', 'Updated Successfully!');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('message', 'Deleted Successfully!');

    }


    public function bulkDestroy(Request $request){

        User::destroy($request->ids);
        return redirect()->route('users.index')->with('message', 'Deleted Successfully!');
    }
}