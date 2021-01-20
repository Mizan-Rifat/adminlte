<?php

namespace Tests\Feature;

use App\Models\AddableItem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

use function GuzzleHttp\Promise\all;

class AddableItemTest extends TestCase
{
    use RefreshDatabase,WithFaker;

    protected $seed = true;

    public function test_addableItem_routes_forbidden_if_not_authorized(){

        $createResponse = $this->get(route('addableitems.create'));
        $editResponse = $this->get(route('addableitems.edit',['addableItem'=>AddableItem::first()]));

        $createResponse->assertForbidden();
        $editResponse->assertForbidden();
    }

    public function test_addableItem_routes_accessable_if_authorized(){
     
        $this->ActAsSuperAdmin();

        $createResponse = $this->get(route('addableitems.create'));
        $editResponse = $this->get(route('addableitems.edit',['addableItem'=>AddableItem::first()]));


        $createResponse->assertOk();
        $editResponse->assertOk();
    }

    public function test_addable_items_can_be_store(){
        $this->ActAsSuperAdmin();

        Storage::fake('my_public');

        $file = UploadedFile::fake()->image('avatar.jpg');

        $this->assertCount(10,AddableItem::all());
        $storeResponse = $this->post(route('addableitems.store'),[
            'name'=> $this->faker->word,
            'image'=>$file,
            'price'=> $this->faker->randomFloat(2,10,150),
        ]);
        Storage::disk('my_public')->assertExists('/images/addableItems/'.$file->hashName());

        $this->assertCount(11,AddableItem::all());

        $storeResponse->assertRedirect(route('addableitems.index'));

    } 

    public function test_addable_items_can_be_update(){
        $this->ActAsSuperAdmin();

        Storage::fake('my_public');

        $file = UploadedFile::fake()->image('avatar.jpg');

        $updatedName = $this->faker->word; 
        $updatedPrice = $this->faker->randomFloat(2,10,150); 


        $storeResponse = $this->post(route('addableitems.update',['addableItem'=>AddableItem::first()->id]),[
            'name'=> $updatedName,
            'image'=>$file,
            'price'=> $updatedPrice,
        ]);

        $updatedAddableItem = AddableItem::first();

        $this->assertEquals($updatedName,$updatedAddableItem->name);
        $this->assertEquals($updatedPrice,$updatedAddableItem->price);
        Storage::disk('my_public')->assertExists('/images/addableItems/'.$file->hashName());

        $this->assertCount(10,AddableItem::all());

        $storeResponse->assertRedirect();

    }

    public function test_addable_items_can_be_destroy(){

        $this->ActAsSuperAdmin();

        $this->assertCount(10,AddableItem::all());

        $id = AddableItem::first()->id;

        $this->assertDatabaseHas('addable_items', [
            'id' => $id,
        ]);

        $deleteResponse = $this->get(route('addableitems.destroy',['addableItem'=>$id]));

        $this->assertCount(9,AddableItem::all());

        $this->assertDatabaseMissing('addable_items', [
            'id' => $id,
        ]);

        $deleteResponse->assertRedirect(route('addableitems.index'));

    }

    public function test_addable_items_can_be_bulk_destroy(){

        $this->withoutExceptionHandling();

        $this->ActAsSuperAdmin();

        $this->assertCount(10,AddableItem::all());

        $ids = AddableItem::limit(5)->pluck('id');

        $this->assertDatabaseHas('addable_items', [
            'id' => $ids,
        ]);

        $deleteResponse = $this->post(route('addableitems.bulkdestroy'),[
            'ids'=>[1,2,3,4,5]
        ]);

        $this->assertCount(5,AddableItem::all());

        $this->assertDatabaseMissing('addable_items', [
            'id' => $ids,
        ]);

        $deleteResponse->assertRedirect(route('addableitems.index'));

    }

    public function test_addable_items_name_price_field_required_validation_failed(){
        $this->ActAsSuperAdmin();
        
        $storeResponse = $this->post(route('addableitems.store'),[
            'nada'=> 'ad',
        ]);

        $storeResponse->assertSessionHasErrors(['name','price']);
    }

    public function test_addable_items_name_field_Unique_validation_failed(){
        $this->ActAsSuperAdmin();
        
        $storeResponse = $this->post(route('addableitems.store'),[
            'name'=> AddableItem::first()->name,
        ]);

        $storeResponse->assertSessionHasErrors([
            'name'=> 'The name has already been taken.',
        ]);
    }

    public function test_addable_items_name_field_Unique_Except_validation_failed(){
        $this->ActAsSuperAdmin();
        
        $storeResponse = $this->post(route('addableitems.update',['addableItem'=>AddableItem::first()->id]),[
            'name'=> AddableItem::first()->name,
        ]);

        $storeResponse->assertSessionDoesntHaveErrors([
            'name'=> 'The name has already been taken.',
        ]);
    }

    public function test_addable_items_Image_field_validation_failed(){
        $this->ActAsSuperAdmin();

        Storage::fake('my_public');

        $file = UploadedFile::fake()->create('avatar.pdf',5300);
        
        $storeResponse = $this->post(route('addableitems.store'),[
            'name'=> $this->faker->word,
            'price'=> $this->faker->randomFloat(2,10,150),
            'image'=>$file
        ]);

        $storeResponse->assertSessionHasErrors([
            'image'=>'The image must be an image.',
            'image'=>'The image may not be greater than 5120 kilobytes.',
        ]);
    }







    public function ActAsSuperAdmin(){
        $super_admin = User::find(1);
        $this->actingAs($super_admin);
    }



}
