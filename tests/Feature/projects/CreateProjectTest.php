<?php

namespace Tests\Feature;

use App\City;
use App\Country;
use App\Project;
use App\Province;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateProjectTest extends TestCase
{
    //use RefreshDatabase;
    /** @test */
    public function an_user_can_create_a_project()
    {
        // 1. Given => Teniendo... usuario autenticado
        // 2. When => Cuando.. hace un post a modificar usuario
        // 3. Then => Entonces.. veo el usuario modificado en la bd    

        // // ANDANDO OK
        $Country =  factory(Country::class)->create();
        $Province =  factory(Province::class)->create(['country_id' => $Country->id]);
        $City =  factory(City::class)->create(['province_id' => $Province->id]);


        $project = factory(Project::class)->create(['city_id' => $City->id])->toArray();
        //$this->post('/api/proyectos', $project);
        $this->assertDatabaseHas('projects', $project);
    }
}
