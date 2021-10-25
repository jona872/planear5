<?php

namespace Tests\Unit;

use GuzzleHttp\Promise\Create;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ToolUnitTest extends TestCase
{
    //use RefreshDatabase;
    use DatabaseTransactions;

    //crear tool, recibe tool_name y tool_creator (se completa autmaticamente)
    /** @test */
    public function the_tool_name_is_required_for_creation()
    {
        $data = [
            "tool_name" => null
        ];

        $response = $this->from('/api/herramientas')->post('/api/herramientas', $data);
        $response->assertSessionHasErrors([
                'tool_name' => 'El nombre de la herramienta es requerido'
            ]);
    }
    

    //
    /** @test */
    public function the_tool_name_is_required_for_updating()
    {
        $data = [
            "tool_name" => null
        ];

        $response = $this->from('/api/herramientas')->post('/api/herramientas', $data);
        $response->assertSessionHasErrors([
                'tool_name' => 'El nombre de la herramienta es requerido'
            ]);
    }

}
