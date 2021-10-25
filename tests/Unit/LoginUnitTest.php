<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;

use App\Project;
use App\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class LoginUnitTest extends TestCase
{
    use DatabaseTransactions;
    /** @test
     */
    public function it_visit_page_of_login()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertSee('Login');
    }

    /** @test */
    public function not_authenticate_a_user_with_invalid_credentials()
    {
        $user = factory(User::class)->create()->toArray();
        $credentials = [
            "email" => "jona_872@hotmail.com",
            "password" => 'randomText'
        ];
        $response = $this->from('/api/login')->post('/api/login', $credentials);
        $response->assertSessionHasErrors();
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
            "email" => "zaratedev@gmail.com",
            "password" => ''
        ];

        $response = $this->post('/api/login', $credentials);
        $response->assertRedirect('');
        $response->assertSessionHasErrors();
    }

}
