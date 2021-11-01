<?php

namespace Tests\Feature;

use App\User;
use Hash;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\WithFaker;
// use Notification;
use Password;
use Illuminate\Support\Str;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class PasswordResetTest extends TestCase
{
    use WithFaker;

    const ROUTE_PASSWORD_EMAIL = 'password.email';
    const ROUTE_PASSWORD_REQUEST = 'password.request';
    const ROUTE_PASSWORD_RESET = 'password.reset';
    const ROUTE_PASSWORD_RESET_SUBMIT = 'password.reset.submit';

    const USER_ORIGINAL_PASSWORD = 'secret';

    /** @test */
    public function showPasswordResetRequestPage()
    {
        $this
            ->get(route(self::ROUTE_PASSWORD_REQUEST))
            ->assertSuccessful()
            ->assertSee('Reset Password')
            ->assertSee('E-Mail Address')
            ->assertSee('Send Password Reset Link');
    }

    /** @test */
    public function submitPasswordResetRequestInvalidEmail()
    {
        $emailToTest =  Str::random(10)."@". Str::random(7).".".Str::random(2);
        $invalidEmail = "@asd.ar@test";
        
        $response = $this->from('/password/reset')->post('/password/email', [$invalidEmail]);
        $response->assertSessionHasErrors();
        //$this->assertSame($emailToTest, filter_var($emailToTest, FILTER_VALIDATE_EMAIL));
        // assertNotSame
    }

    /** @test */
    public function submitPasswordResetRequestValidEmail()
    {

    }
}
