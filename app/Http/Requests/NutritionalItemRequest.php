<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;

class NutritionalItemRequest extends FormRequest
{

    public function authorize()
    {
        if(Route::currentRouteName() == 'nutritionalitems.store'){
            return Gate::authorize(get_gate_action('NutritionalItem','create'));
        }else{
            return Gate::authorize(get_gate_action('NutritionalItem','update'));
        }
    }

    public function rules()
    {
        if(Route::currentRouteName() == 'nutritionalitems.store'){
            return [
                'title'=>['required','string','unique:nutritional_items,title'],
            ];
        }else{
            return [
                'title'=>['string',Rule::unique('nutritional_items','title')->ignore($this->nutritionalItem)],
            ];
        }
    }



}
