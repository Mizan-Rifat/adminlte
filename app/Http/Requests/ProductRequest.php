<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;

class ProductRequest extends FormRequest
{


    public function authorize()
    {
        if(Route::currentRouteName() == 'products.store'){
            return Gate::authorize(get_gate_action('Product','create'));
        }else{
            return Gate::authorize(get_gate_action('Product','update'));
        };
    }

    public function rules()
    {
        if(Route::currentRouteName() == 'products.store'){
            return [
                'name' => ['required','string','unique:products,name'],
                'image' => ['image','max:5120'],
                'category_id' => ['required','numeric','exists:categories,id'],
                'ingredients' => ['array'],
                'ingredients.*' => ['numeric','exists:ingredients,id'],
                'addableItems' => ['array'],
                'addableItems.*' => ['numeric','exists:addable_items,id'],
                'description' => ['nullable','string'],
                'price'=>['required','regex:/^\d+(\.\d{1,2})?$/'],
                'active' => ['boolean'],
            ];
        }else{
            return [
                'name' => ['string',Rule::unique('products','name')->ignore($this->product)],
                'category_id' => ['numeric','exists:categories,id'],
                'ingredients' => ['array'],
                'ingredients.*' => ['numeric','exists:ingredients,id'],
                'addableItems' => ['array'],
                'addableItems.*' => ['numeric','exists:addable_items,id'],
                'image' => ['image','max:5120'],
                'description' => ['nullable','string'],
                'price'=>['regex:/^\d+(\.\d{1,2})?$/'],
                'active' => ['boolean'],
            ];
        }

    }

//    public function messages()
//    {
//
//    }


}
