<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddableItemsTable extends Migration
{

    public function up()
    {
        Schema::create('addable_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('image')->nullable();
            $table->decimal('price',12,2)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('addable_items');
    }
}
