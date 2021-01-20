<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class ProductRequest extends FormRequest
{

    private $storeRules = [];

    private $updateRules = [];

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
       return Route::currentRouteName() == 'products.store' ? $this->storeRules : $this->updateRules;
    }

//    public function messages()
//    {
//
//    }


}
