<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $appends = ['formatted_price','isActive'];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function ingredients(){
        return $this->belongsToMany(Ingredient::class);
    }

    public function addableItems(){
        return $this->belongsToMany(AddableItem::class);
    }
    
    public function getFormattedPriceAttribute($value){

        return money($this->price, 'BDT',true)->format();
        
    }

    public function getIsActiveAttribute($value){

        return $this->active ? 'Yes' : 'No';
        
    }
    
}