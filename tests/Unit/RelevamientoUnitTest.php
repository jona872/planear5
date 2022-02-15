<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class RelevamientoUnitTest extends TestCase
{
    //use RefreshDatabase;
    use DatabaseTransactions;

    /** @test */
    public function the_project_name_is_required_for_creation()
    {
        $data = ["project_id" => null];

        $response = $this->from('/relevamientos/pre-create')->post('/api/pos-create', $data);
        $response->assertSessionHasErrors([
            'project_id' => 'El nombre del projecto es requerido'
        ]);
    }

    /** @test */
    public function the_tool_name_is_required_for_creation()
    {
        $data = ["tool_id" => null];

        $response = $this->from('/api/herramientas')->post('/api/herramientas', $data);
        $response->assertSessionHasErrors([
            'tool_name' => 'El nombre de la herramienta es requerido'
        ]);
    }

    /** @test */
    public function the_project_id_need_to_be_numeric()
    {
        $data = ['project_id' => 'cinco'];

        $response = $this->from('/relevamientos/pre-create')->post('/api/pos-create', $data);
        $response->assertSessionHasErrors([
            'project_id' => 'El identificativo debe ser numerico'
        ]);
    }

    /** @test */
    public function the_tool_id_need_to_be_numeric()
    {
        $data = ['tool_id' => 'cinco'];

        $response = $this->from('/relevamientos/pre-create')->post('/api/pos-create', $data);
        $response->assertSessionHasErrors([
            'tool_id' => 'El identificativo debe ser numerico'
        ]);
        // $response->dumpSession();
    }
}
