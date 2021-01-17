<?php

namespace Tests\Feature;

use App\Http\Requests\IngredientRequest;
use App\Models\Ingredient;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use MohammedManssour\FormRequestTester\TestsFormRequests;

class IngredientTest extends TestCase
{
    use RefreshDatabase,TestsFormRequests;

    protected $seed = true;

    public function test_ingredient_store_update_forbidden_for_unauthorized_user(){

        $response = $this->post(route('ingredients.store'),[
            'name'=>'fsf',
        ]);

        $response->assertForbidden();
    }

    public function test_ingredient_store(){

        
        $admin = User::find(1);
        $this->actingAs($admin);

        $this->assertCount(0,Ingredient::all());

        $response = $this->post(route('ingredients.store'),[
            'name'=>'fsf',
        ]);

        $this->assertCount(1,Ingredient::all());

        $response->assertRedirect(route('ingredients.index'));
    }

    public function test_ingredient_update(){

        $admin = User::find(1);
        $this->actingAs($admin);

        Ingredient::factory()->create();
        $ingredient = Ingredient::first();
        $name = $ingredient->name;

        $response = $this->post(route('ingredients.update',['ingredient'=>$ingredient->id]),[
            'name'=>'fsf',
        ],);

        $this->assertDatabaseHas('ingredients',[
            'name'=>'fsf',
        ]);
        $this->assertDatabaseMissing('ingredients',[
            'name'=>$name,
        ]);
    }

    public function test_ingredient_delete(){
        $admin = User::find(1);
        $this->actingAs($admin);

        Ingredient::factory()->create();
        $ingredient = Ingredient::first();
        $name = $ingredient->name;

        $this->assertCount(1,Ingredient::all());

        $response = $this->get(route('ingredients.destroy',['ingredient'=>$ingredient->id]));

        $this->assertCount(0,Ingredient::all());

        $response->assertRedirect(route('ingredients.index'));
    }

    public function test_ingredient_store_name_unique_validation(){

        Ingredient::factory()->create([
            'name'=>'ingredient'
        ]);

        $response = $this->post(route('ingredients.store'),[
            'name'=>'ingredient',
        ]);

        $response->assertSessionHasErrors(['name']);

    }


}
