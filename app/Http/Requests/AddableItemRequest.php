<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class AddableItemRequest extends FormRequest
{

    private $storeRules = [];

    private $updateRules = [];

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
       return Route::currentRouteName() == 'addableItems.store' ? $this->storeRules : $this->updateRules;
    }

//    public function messages()
//    {
//
//    }


}
