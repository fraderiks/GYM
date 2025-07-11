<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

describe('Authentication', function () {
    describe('Unauthorized user', function () {
        test('will be redirected to login page', function () {
            $response = $this->get('/admin');
            $response->assertRedirect('/login');
        });

        test('login page will show email & password input', function () {
            $response = $this->get('/login');
            $response->assertStatus(200);
            $response->assertSee('Email');
            $response->assertSee('Password');
            $response->assertSee('Login');
        });
    });

    describe('Authorized user', function () {
        uses(RefreshDatabase::class);

        beforeEach(function () {
            $this->user = User::factory()->adminRole()->create();
            $this->actingAs($this->user);
        });

        test('can visit admin page', function() {
            $response = $this->get('/admin');
            $response->assertStatus(200);
            $response->assertSee('Admin Page');
        });

        test('logout', function () {
            $this->post('/logout');
            $this->assertGuest();
        });
    });

    describe('Login', function() {
        uses(RefreshDatabase::class);

        test('user can login with valid credential', function () {
            $user = User::factory()->adminRole()->create(
                ['email' => 'user@test.com', 'password' => Hash::make('password')]
            );

            $this->post('/login', 
                ['email' => $user->email, 'password' => 'password']);

            $this->assertAuthenticatedAs($user);
        });

        test('user cannot login with invalid credential', function () {
            $this->get('/login');
            $response = $this->post('/login', ['email' => 'user@some.domain', 'password' => 'some password']);

            $response->assertRedirectBack();
            $this->assertGuest();
        });

    });
});