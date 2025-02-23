<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    public function test_a_user_can_register()
    {

        $this->postJson(route('user.register'),[
            'name' => "ahmed",
            'email' => 'ahmed@admin.com',
            'password' => '123456789',
            'password_confirmation' => '123456789',
        ])->assertCreated();

        $this->assertDatabaseHas('users',['name' => 'ahmed']);
    }
}
