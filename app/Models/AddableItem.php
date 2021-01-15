<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class AddableItem extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    
}