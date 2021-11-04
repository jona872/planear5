<?php

namespace Tests\Feature;

use App\City;
use App\Country;
use App\Project;
use App\Province;
use App\Relevamiento;
use App\Tool;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RelevamientoTest extends TestCase
{

    use DatabaseTransactions; //Borra solo lo creado actualmente
    /** @test */
    public function an_user_can_create_a_relevamiento()
    {
        $user = factory(User::class)->create(['admin' => 1]);
        $Country =  factory(Country::class)->create();
        $Province =  factory(Province::class)->create(['country_id' => $Country->id]);
        $City =  factory(City::class)->create(['province_id' => $Province->id]);
        $project = factory(Project::class)->create(['city_id' => $City->id]);
        $tool = factory(Tool::class)->create(['user_id' => $user->id]);

        $relevamiento = factory(Relevamiento::class)->create([
            'project_id' => $project->id,
            'tool_id' => $tool->id,
            'user_id' => $user->id,
        ])->toArray();

        $response = $this->post('/api/relevamientos', $relevamiento);
        $response->assertStatus(200);
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('relevamientos', $relevamiento);
    }


    /** @test */
    public function an_user_can_delete_a_relevamiento()
    {
        $user = factory(User::class)->create(['admin' => 1]);
        $Country =  factory(Country::class)->create();
        $Province =  factory(Province::class)->create(['country_id' => $Country->id]);
        $City =  factory(City::class)->create(['province_id' => $Province->id]);
        $project = factory(Project::class)->create(['city_id' => $City->id]);
        $tool = factory(Tool::class)->create(['user_id' => $user->id]);

        $relevamiento = factory(Relevamiento::class)->create([
            'project_id' => $project->id,
            'tool_id' => $tool->id,
            'user_id' => $user->id,
        ])->toArray();


        $route = '/api/relevamientos/'. $relevamiento['id'];
        $response = $this->call('DELETE', $route, array(   
            '_token' => csrf_token(),
        ));

        // Chequear si hizo el delete
        $response->assertStatus(302);
        $response->assertRedirect('/relevamientos');       
        $response->assertSessionHas('success', 'Relevamiento Eliminado correctamente!');
    }

}
