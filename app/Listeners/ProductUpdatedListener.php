<?php

namespace App\Listeners;

use App\Events\ProductUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Storage;

class ProductUpdatedListener
{
    
    public function __construct()
    {
        //
    }

    public function handle(ProductUpdated $event)
    {

        if(isset($event->data['image'])){
            
            if($event->prevImage != null){
                Storage::delete($event->prevImage);
            }
            
            $file = $event->data['image'];
            $file->store('images/products');

            $event->product->image = "images/products/".$file->hashName();

            $event->product->save();
            
        }

        if(isset($event->data['ingredients'])){
            $event->product->ingredients()->sync($event->data['ingredients']);
        }
    }
}
