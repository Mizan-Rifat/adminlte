<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Akaunting\Money\Currency as Akaunting;

class AddableItem extends Model
{
    use HasFactory;

    protected $table = 'addable_items';

    protected $appends = ['formatted_price'];

    protected $guarded = ['id'];

    public function getFormattedPriceAttribute($value){

        return money($this->price, 'BDT',true)->format();
        
    }
    
}