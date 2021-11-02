<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;

use App\Project;
use App\User;
use GuzzleHttp\Promise\Create;
use Session;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginUnitTest extends TestCase
{
    //use RefreshDatabase; //Borra todo
    use DatabaseTransactions;

    /** @test
     */
    public function a_user_can_visit_the_login_page()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertSee('Login');
    }

    /** @test */
    public function a_user_can_request_password_recovery()
    {
        $response = $this->get('/password/reset');
        $response->assertStatus(200);
        $response->assertSee('email');
    }

    /** @test */
    public function authenticated_a_user_with_valid_credentials()
    {
        $user = new User;
        $user->email = "testingEmail@hotmail.com";
        $user->password = bcrypt("testingpassword");
        $user->save();

        $this->get('/login')->assertSee('Login');
        $credentials = [
            "email" => "testingEmail@hotmail.com",
            "password" => "testingpassword"
        ];

        $response = $this->post('/api/login', $credentials);
        $this->assertCredentials($credentials);
    }

    /** @test */
    public function not_authenticate_a_user_with_invalid_credentials()
    {
        $user = factory(User::class)->create(['email' => 'InvalidCredentials@hotmail.com']);
        $credentials = [
            'email' => 'InvalidCredentials@hotmail.com',
            'password' => 'wrongPassword'
        ];

        $response = $this->from('/api/login')->post('/api/login', $credentials);
        $this->assertInvalidCredentials($credentials);
    }

    /** @test */
    public function the_email_is_required_for_authentication()
    {
        $user = factory(User::class)->create()->toArray();
        $credentials = [
            "email" => null,
            "password" => "password"
        ];

        $response = $this->from('/api/login')->post('/api/login', $credentials);
        $response->assertRedirect('/api/login')
            ->assertSessionHasErrors([
                'email' => 'The email field is required.',
            ]);
    }

    /** @test */
    public function the_password_is_required_for_authentication()
    {
        $credentials = [
            "email" => "ramdomEmail@gmail.com",
            "password" => ''
        ];

        $response = $this->post('/api/login', $credentials);
        $response->assertRedirect('');
        $response->assertSessionHasErrors();
    }
}
