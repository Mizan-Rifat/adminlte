<?php

namespace Tests\Feature;

use App\Models\Ingredient;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IngredientTest extends TestCase
{
    use RefreshDatabase;

    protected $seed = true;

    public function test_ingredient_store_forbidden_for_unauthorized_user(){

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
}
