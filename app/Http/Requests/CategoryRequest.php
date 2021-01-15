<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class CategoryRequest extends FormRequest
{

    private $storeRules = [];

    private $updateRules = [];

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
       return Route::currentRouteName() == 'categories.store' ? $this->storeRules : $this->updateRules;
    }

//    public function messages()
//    {
//
//    }


}
