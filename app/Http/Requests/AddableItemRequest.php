<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;

class AddableItemRequest extends FormRequest
{

    public function authorize(){
        
        if(Route::currentRouteName() == 'addableitems.store'){
            return Gate::authorize(get_gate_action('AddableItem','create'));
        }else{
            return Gate::authorize(get_gate_action('AddableItem','update'));
        }

    }

  

    public function rules()
    {
        if(Route::currentRouteName() == 'addableitems.store'){
            return [
                'name'=>['required','string','unique:addable_items,name'],
                'price'=>['required','regex:/^\d+(\.\d{1,2})?$/'],
                'image'=>['image','max:5120'],
            ];
        }else{
            return [
                'name'=>['string',Rule::unique('addable_items','name')->ignore($this->addableItem)],
                'price'=>['regex:/^\d+(\.\d{1,2})?$/'],
                'image'=>['image','max:5120'],
            ];
        }
    }

       public function messages()
        {
            return [
                'image.max' => 'The images may not be greater than :max kilobytes.'
            ];
        }




}
