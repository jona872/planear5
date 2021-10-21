<?php

namespace Tests\Feature;

use App\City;
use App\Country;
use App\Project;
use App\Province;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateProjectTest extends TestCase
{
    //use RefreshDatabase;
    /** @test */
    public function an_user_can_update_a_project()
    {
        $Country =  factory(Country::class)->create();
        $Province =  factory(Province::class)->create(['country_id' => $Country->id]);
        $City =  factory(City::class)->create(['province_id' => $Province->id]);
        $project = factory(Project::class)->create(['city_id' => $City->id]);
 
        $response = $this->call('PUT', '/api/proyecto-editar/' . $project->id, array(
            '_token' => csrf_token(),
            'project_name' => 'El Brechas',
        ));
        // Chequear si hizo el edit
        $response->assertStatus(302);

        $project->refresh();
        $this->assertEquals('El Brechas', $project->project_name);
    }
}
