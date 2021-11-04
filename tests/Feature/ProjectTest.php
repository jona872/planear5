<?php

namespace Tests\Feature;

use App\City;
use App\Country;
use App\Project;
use App\Province;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    //use RefreshDatabase; //Borra todo
    // use DatabaseTransactions; //Borra solo lo creado actualmente
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
        $response = $this->post('/api/proyectos', $project);
        $response->assertStatus(302);
        $response->assertSessionHas('success', 'Proyecto creado correctamente!');
        $response->assertRedirect('/projects');
        $this->assertDatabaseHas('projects', $project);
    }

    /** @test */
    public function a_user_can_update_a_project()
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
        $response->assertRedirect('/projects');
        $response->assertSessionHas('success', 'Proyecto editado correctamente!');
        $project->refresh();
        $this->assertEquals('El Brechas', $project->project_name);
    }

    /** @test */
    public function an_user_can_delete_a_project()
    {
        $Country =  factory(Country::class)->create();
        $Province =  factory(Province::class)->create(['country_id' => $Country->id]);
        $City =  factory(City::class)->create(['province_id' => $Province->id]);
        $project = factory(Project::class)->create(['city_id' => $City->id]);


        $route = '/api/proyectos/'. $project->id;
        $response = $this->call('DELETE', $route, array(   
            '_token' => csrf_token(),
        ));

        // Chequear si hizo el delete
        $response->assertStatus(302);
        $response->assertRedirect('/projects');       
        $response->assertSessionHas('success', 'Proyecto eliminado correctamente');
    }
}
