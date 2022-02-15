<?php

namespace Tests\Feature;

use App\Data;
use App\Tool;
use App\ToolData;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;

class DataTest extends TestCase
{
    //use RefreshDatabase; //Borra todo
    use DatabaseTransactions; //Borra solo lo creado actualmente
    
    /** @test */
    public function an_user_makes_a_successfull_data_creation()
    {
        $data = factory(Data::class)->create();
        $this->assertDatabaseHas('data', $data->toArray());
    }
    
    /** @test */
    public function data_associate_successfull()
    {
        $user = factory(User::class)->create();
        $tool = factory(Tool::class)->create(['user_id' => $user->id]);

        $data = factory(Data::class)->create();

        $tool_data = factory(ToolData::class)->create(['tool_id' => $tool->id, 'data_id' => $data->id]);

        //$response = $this->post('/api/', ['data_question0'=> $data->data_question, ]);
        // $response->assertStatus(302);
        // $response->assertSessionHas('success', 'Preguntas agregadas correctamente');
        // $response->assertRedirect('/tools');
        $this->assertDatabaseHas('tools_data', $tool_data->toArray());
    }
}
