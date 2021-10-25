<?php

namespace Tests\Unit;

use App\Project;
use GuzzleHttp\Promise\Create;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ProjectUnitTest extends TestCase
{
    //use RefreshDatabase;
    use DatabaseTransactions;

    //crear projecto -> 
    /** @test */
    public function the_project_name_is_required_for_creation()
    {
        $data = [
            "project_name" => null
        ];

        $response = $this->from('/api/proyectos')->post('/api/proyectos', $data)
            ->assertSessionHasErrors([
                'project_name' => 'El nombre del proyecto es requerido'
            ]);
    }

    /** @test */
    public function the_city_id_is_numeric_type()
    {
        $data = [
            "city_id" => "1"
        ];

        $response = $this->from('/api/proyectos')->post('/api/proyectos', $data);
        $response = $this->assertIsNotInt($data['city_id']);
    }
    /** @test */
    public function the_city_id_is_required_for_creation()
    {
        $data = [
            "city_id" => null
        ];

        $response = $this->from('/api/proyectos')->post('/api/proyectos', $data);
        $response->assertRedirect('/api/proyectos')
            ->assertSessionHasErrors([
                'city_id' => 'La ciudad es requerida'
            ]);
    }

    //editar projecto
}
