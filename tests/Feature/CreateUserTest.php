<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateUserTest extends TestCase
{
    // use RefreshDatabase;
    /** @test */
    public function a_user_can_be_created()
    {

        // 1. Given => Teniendo... usuario autenticado
        // 2. When => Cuando.. hace un post a modificar usuario
        // 3. Then => Entonces.. veo el usuario modificado en la bd    

        // ANDANDO OK, TIEMPO =  1.36s
        $userCreado = factory(User::class)->create()->toArray();
        $this->post('/register', $userCreado);
        $this->assertDatabaseHas('users', $userCreado);

        // // ANDANDO OK, TIEMPO = 1.53s
        // $new = factory(User::class)->create()->toArray();
        // $this->post('/register', $new);
        // $expectedNew = User::find($new['id']);
        // $this->assertNotNull($expectedNew);
        // $this->assertEquals($new['id'], intval($expectedNew->only(['id'])));
    }
}
