<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;

class AddableItemRequest extends FormRequest
{

  

    public function rules()
    {
        if(Route::currentRouteName() == 'addableitems.store'){
            return [
                'name'=>['required','string','unique:addable_items,name'],
                'price'=>['required','regex:/^\d+(\.\d{1,2})?$/'],
                'images'=>['nullable','array'],
                'images.*'=>['image','max:2048'],
            ];
        }else{
            return [
                'name'=>['string',Rule::unique('addable_items','name')->ignore($this->addableItem)],
                'price'=>['regex:/^\d+(\.\d{1,2})?$/'],
                'images'=>['nullable','array'],
                'images.*'=>['image','max:2048'],
            ];
        }
    }

       public function messages()
        {
            return [
                'images.*.max' => 'The images may not be greater than :max kilobytes.'
            ];
        }




}
