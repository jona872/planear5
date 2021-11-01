<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    //use RefreshDatabase;
    use DatabaseTransactions; //Borra solo lo creado actualmente
    /** @test */
    public function a_user_can_be_created()
    {
        // 1. Given => Teniendo... usuario autenticado
        // 2. When => Cuando.. hace un post a modificar usuario
        // 3. Then => Entonces.. veo el usuario modificado en la bd    

        // ANDANDO OK, TIEMPO =  1.36s
        $userCreado = factory(User::class)->create()->toArray();
        // $this->post('/register', $userCreado);
        $this->assertDatabaseHas('users', $userCreado);
    }

    /** @test */
    public function an_admin_can_edit_user()
    {
        $user = factory(User::class)->create(['admin' => 1]);
        $data = false;

        $response = $this->call('GET', '/admin-panel/setAdmin/', array(
            '_token' => csrf_token(),
            'id' => $user->id,
            'val' => $data,
        ));
        // Chequear si hizo el edit   
        $response->assertStatus(200); //200 xq es un get, no hago redirect
        $user->refresh();
        $this->assertEquals($data, $user->admin);
    }

}
