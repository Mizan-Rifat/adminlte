<?php

namespace App\Listeners;

use App\Events\ProductDeleted;
use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Storage;

class ProductDeletedListener
{
    
    public function __construct()
    {
        
    }

    
    public function handle(ProductDeleted $event)
    {

        $products = $event->product instanceof Product ? collect([$event->product]) : $event->product;

        $products->map(function($product) use($event) {
            Storage::delete($product->image);

            $product->ingredients()->sync([]);
            $product->addableItems()->sync([]);
            $product->nutritionalValues()->sync([]);
        });
        
    }
}
