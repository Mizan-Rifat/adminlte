<?php

namespace Tests\Feature;

use App\Models\NutritionalItem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NutritionalItemTest extends TestCase
{
   
    use RefreshDatabase,WithFaker;

    protected $seed = true;

    public function test_nutritionalItem_routes_forbidden_if_not_authorized(){

        $responses = $this->routeResponses();

        foreach ($responses as $key => $response) {
            $response->assertForbidden();
        }
       
    }

    public function test_nutrional_items_can_be_stored(){
        $this->ActAsSuperAdmin();

        $this->assertCount(10,NutritionalItem::all());

        $storeResponse = $this->post(route('nutritionalitems.store'),[
            'title'=> $this->faker->word,
        ]);

        $this->assertCount(11,NutritionalItem::all());

        $storeResponse->assertRedirect(route('nutritionalitems.index'));

    } 

    public function test_nutrional_items_can_be_updated(){
        $this->ActAsSuperAdmin();

        $this->assertCount(10,NutritionalItem::all());

        $updatedName = $this->faker->word;

        $updateResponse = $this->post(route('nutritionalitems.update',
            ['nutritionalItem'=>NutritionalItem::first()->id]),
            [
                'title'=> $updatedName,
            ]);

        $updatedNutritionalItem = NutritionalItem::first();

        $this->assertEquals($updatedName,$updatedNutritionalItem->title);

        $this->assertCount(10,NutritionalItem::all());

        $updateResponse->assertRedirect();

    } 








    public function routeResponses(){
        $browseResponse = $this->get(route('nutritionalitems.index'));
        $showResponse = $this->get(route('nutritionalitems.show',['nutritionalItem'=>NutritionalItem::first()->id]));
        $createResponse = $this->get(route('nutritionalitems.create'));
        $editResponse = $this->get(route('nutritionalitems.edit',['nutritionalItem'=>NutritionalItem::first()->id]));
        $deleteResponse = $this->get(route('nutritionalitems.destroy',['nutritionalItem'=>NutritionalItem::first()->id]));

        
        $storeResponse = $this->post(route('nutritionalitems.store'));
        $updateResponse = $this->post(route('nutritionalitems.update',['nutritionalItem'=>NutritionalItem::first()->id]));
        $bulkDeleteResponse = $this->post(route('nutritionalitems.bulkdestroy'));
        
        return [
            'browseResponse'=>$browseResponse,
            'showResponse'=>$showResponse,
            'createResponse'=>$createResponse,
            'storeResponse'=>$storeResponse,
            'editResponse'=>$editResponse,
            'updateResponse'=>$updateResponse,
            'deleteResponse'=>$deleteResponse,
            'bulkDeleteResponse'=>$bulkDeleteResponse
        ];
    }

    public function ActAsSuperAdmin(){
        $super_admin = User::find(1);
        $this->actingAs($super_admin);
    }


}
