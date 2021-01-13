<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class CRUDController extends Controller
{

    public function index(){
        return view('admin.crud.crud');
    }
    public function crud(Request $request){
        $columns = [];
        $table = [];

        $fields['migration'] = $request->migration;
        $fields['model'] = $request->model;
        $fields['controller'] = $request->controller;
        $fields['formRequest'] = $request->formRequest;
        $fields['routes'] = $request->routes;

        if($request->migration){

            foreach ($request->name as $i => $name) {
                $array = [
                    'name'=>$name,
                    'type'=>$request->type[$i],
                    'nullable'=>$request->nullable[$i],
                    'default'=>$request->default[$i]
                ];

                array_push($columns,$array);
            }

            $table['name'] = $request->table_name;
            $table['id'] = $request->id;
            $table['timestamps'] = $request->timestamps;
            $table['columns'] = $columns;
        }

        $data = [
            'model_name'=>$request->model_name,
            'table'=>$table,
            'fields'=>$fields,
        ];

        return Artisan::call('crud:generator', ['data'=>$data]);
    }
}
