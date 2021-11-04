<?php

namespace Tests\Feature;

use App\Answer;
use App\City;
use App\Country;
use App\Data;
use App\DataAnswer;
use App\Project;
use App\Province;
use App\Relevamiento;
use App\Tool;
use App\ToolData;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AnswerTest extends TestCase
{
    //use RefreshDatabase; //Borra todo
    use DatabaseTransactions; //Borra solo lo creado actualmente
    
    /** @test */
    public function an_user_makes_a_successfull_answer_creation()
    {
        $data = factory(Answer::class)->create();
        $this->assertDatabaseHas('answers', $data->toArray());
    }
    
    /** @test */
    public function data_associate_successfull()
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
        ]);

        $data = factory(Data::class)->create();
        $answer = factory(Answer::class)->create();
        
        $dataAnsers = factory(DataAnswer::class)->create(['data_id' => $data->id,'answer_id' => $answer->id,'relevamiento_id' => $relevamiento->id ]);
        $tool_data = factory(ToolData::class)->create(['tool_id' => $tool->id, 'data_id' => $data->id]);
        
        $this->assertDatabaseHas('tools_data', $tool_data->toArray());
    }
}
