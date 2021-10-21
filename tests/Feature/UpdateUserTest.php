<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;
use Mockery;

class UpdateUserTest extends TestCase
{
    // use RefreshDatabase;
    /** @test */
    public function an_admin_can_edit_user()
    {
        // // ANDANDO OK, TIEMPO =  1.36s
        $userCreado = factory(User::class)->create()->toArray();
        $this->post('/register', $userCreado);
        $this->assertDatabaseHas('users', $userCreado);

        // //dd($userCreado['id']);
        // $userNotAdmin = factory(User::class)->create()->toArray();
        // $this->post('/register', $userNotAdmin);
        // $this->assertDatabaseHas('users', $userNotAdmin);
    }
}
