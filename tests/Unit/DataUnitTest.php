<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class DataUnitTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function the_question_name_is_not_required_for_creation()
    {
        $data = [
            "data_question" => null
        ];
        $this->assertNull($data['data_question']);
        
        $response = $this->post('/api/datos', $data);
        $response->assertSessionHas('success', 'Preguntas agregadas correctamente');
    }

    /** @test */
    public function the_question_name_accpet_alfanumeric()
    {
        $data = [
            "data_question" => '123qwerQWERº@#~¿?'
        ];        
        $response = $this->post('/api/datos', $data);
        $response->assertSessionHas('success', 'Preguntas agregadas correctamente');
    }


}
