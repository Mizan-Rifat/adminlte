<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;

class IngredientRequest extends FormRequest
{


    public function authorize()
    {
        return true;
    }

    public function rules()
    {

        if(Route::currentRouteName() == 'ingredients.store'){
            return [
                'name'=>['required','string','unique:ingredients,name']
            ];
        }else{
            return [
                'name'=>['required','string',Rule::unique('ingredients','name')->ignore($this->ingredient)]
            ];
        }

    }

//    public function messages()
//    {
//
//    }


}
