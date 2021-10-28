<?php

namespace Tests\Feature;

use App\Tool;
use App\User;
use App\Data;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;

class ToolTest extends TestCase
{
    //use RefreshDatabase; //Borra todo
    use DatabaseTransactions; //Borra solo lo creado actualmente

    /** @test */
    public function an_user_makes_a_successfull_tool_creation()
    {
        $user = factory(User::class)->create();
        $data = [
            "tool_name" => Str::random(10),
            "user_id" => $user->id
        ];
        $response = $this->post('/api/herramientas', $data);
        $response->assertStatus(302);
        $response->assertSessionHas('success', 'Herramienta creada corractamente');
        $response->assertRedirect('/tools');
        $this->assertDatabaseHas('tools', $data);
    }

    /** @test */
    public function a_user_can_update_a_tool()
    {
        $user = factory(User::class)->create();

        $tool  = new Tool;
        $tool->tool_name = Str::random(10);
        $tool->user_id = $user->id;
        $tool->save();

        $response = $this->call('PUT', '/api/herramienta-editar/' . $tool->id, array(
            '_token' => csrf_token(),
            'tool_name' => 'El Brechas',
        ));
        // Chequear si hizo el edit
        $response->assertStatus(302);
        $response->assertRedirect('/tools');
        $tool->refresh();
        $this->assertEquals('El Brechas', $tool->tool_name);
    }


    /** @test */
    public function an_user_can_delete_a_tool_successfully()
    {
        $user = factory(User::class)->create();

        $tool  = new Tool;
        $tool->tool_name = Str::random(10);
        $tool->user_id = $user->id;
        $tool->save();

        $route = '/api/herramientas/' . $tool->id;
        $response = $this->call('DELETE', $route, array(
            '_token' => csrf_token(),
        ));

        // Chequear si hizo el delete
        $response->assertStatus(302);
        $response->assertRedirect('/tools');
        $response->assertSessionHas('success', 'Herramienta eliminada correctamente');
    }

    /** @test */
    public function an_user_can_add_data_to_a_tool()
    {
        $user = factory(User::class)->create();

        $tool  = new Tool;
        $tool->tool_name = Str::random(10);
        $tool->user_id = $user->id;
        $tool->save();

        $data = [
            'data_question' => Str::random(10),
        ];

        $response = $this->post('/api/datos', [
            'tool_id' => $tool->id,
            'data_question0' => $data['data_question']]);       

        $response->assertStatus(302);
        $response->assertSessionHas('success', 'Preguntas agregadas correctamente');
        $response->assertRedirect('/tools');
        $this->assertDatabaseHas('data', $data);
    }
}
