<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AnswerUnitTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function the_answer_name_is_not_required_for_creation()
    {
        $data = [
            "answer_name" => null
        ];
        $this->assertNull($data['answer_name']);
        
        $response = $this->post('/api/respuestas', $data);
        $response->assertSessionHas('success', 'Respuestas agregadas correctamente');
    }

    /** @test */
    public function the_answer_name_accpet_alfanumeric()
    {
        $data = [
            "answer_name" => '123qwerQWERº@#~¿?'
        ];        
        $response = $this->post('/api/respuestas', $data);
        $response->assertSessionHas('success', 'Respuestas agregadas correctamente');
    }
}
