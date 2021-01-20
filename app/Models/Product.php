<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function category(){
        return $this->belongsTo(Category::class);
    }
    
    public function ingredients(){
        return $this->belongsToMany(Ingredient::class);
    }

    public function addableItems(){
        return $this->belongsToMany(AddableItem::class);
    }
    // public function nutritionalValues(){
    //     return $this->belongsToMany(NutritionalItem::class,'products_nutritional_values','product_id','item_id')->withPivot('value');
    // }
    
}