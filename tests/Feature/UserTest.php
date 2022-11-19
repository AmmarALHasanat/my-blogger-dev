<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{

    /** @test */
    public function user_can_register_successfully_with_valid_data()
    {
        $response = $this->register([
            'name'=>'test',
            'email'=>fake()->safeEmail(),
            'password'=>'password',
            'c_password'=>'password'
        ]);
        // $response->assertStatus(201);
        $response->assertStatus(200)->assertJson([
            'success'=>true,
            'data'=>[
                'name'=>'test',
                'email'=> User::latest()->first()->email
            ],
            'message'=>'User register successfully'
        ]);
    }

    /** @test */
    public function user_cannot_register_with_email_already_exists()
    {
        $response = $this->register([
            'name'=>'test',
            'email'=> User::first()->email,
            'password'=>'password',
            'c_password'=>'password'
        ]);
        $response->assertStatus(422)->assertJson([
            'message'=>'The email has already been taken.'
        ]);
    }

    /** @test */
    public function user_cannot_register_with_invalid_email()
    {
        $response = $this->register([
            'name'=>'test',
            'email'=> 'test',
            'password'=>'password',
            'c_password'=>'password'
        ]);
        $response->assertStatus(422)->assertJson([
            'message'=>'The email must be a valid email address.'
        ]);
    }

    /** @test */
    public function user_cannot_register_with_password_less_than_6_characters()
    {
        $response = $this->register([
            'name'=>'test',
            'email'=> fake()->safeEmail(),
            'password'=>'pass',
            'c_password'=>'pass'
        ]);
        $response->assertStatus(422)->assertJson([
            'message'=>'The password must be at least 6 characters.'
        ]);
    }

    /** @test */
    public function user_cannot_register_with_password_and_confirm_password_not_match()
    {
        $response = $this->register([
            'name'=>'test',
            'email'=> fake()->safeEmail(),
            'password'=>'password',
            'c_password'=>'pass'
        ]);
        $response->assertStatus(422)->assertJson([
            'message'=>'Confirm password must be same as password'
        ]);
    }

    /** @test */
    public function user_can_login_successfully_with_valid_data()
    {
        $user = User::first();
        $response = $this->login([
            'email'=>$user->email,
            'password'=>'password'
        ]);
        $response->assertStatus(200)->assertJson([
            'success'=>true,
            'data'=>[
                'name'=>$user->name,
                'email'=>$user->email,
            ],
            'message'=>'User login successfully'
        ]);
    }

    /** @test */
    public function user_cannot_login_with_invalid_email()
    {
        $response = $this->login([
            'email'=>'fake',
            'password'=>'password'
        ]);
        $response->assertStatus(422)->assertJson([
            'message' => 'The email must be a valid email address.',
        ]);
    }

    /** @test */
    public function user_cannot_login_with_invalid_password()
    {
        $response = $this->login([
            'email'=>User::first()->email,
            'password'=>'testpass'
        ]);
        $response->assertStatus(400)->assertJson([
            'success' => false,
            'message' => 'User is not authenticated'
        ]);
    }

    /** @test */
    public function user_cannot_login_with_invalid_email_and_password()
    {
        $response = $this->login([
            'email'=>'fake',
            'password'=>'pass'
        ]);
        $response->assertStatus(422)->assertJson([
            'message'=>'The email must be a valid email address. (and 1 more error)',
            'errors'=>[
                'email'=>['The email must be a valid email address.'],
                'password'=>['The password must be at least 6 characters.']
            ]
        ]);
    }
    

}
