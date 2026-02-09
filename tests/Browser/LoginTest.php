<?php

/**
 * @file
 */

declare(strict_types=1);

use App\Models\User;

/**
 * @file
 */


/**
 * @file
 */

it('It Login a User', function () {
    $user = User::factory()->create(['password' => '123456789']);
  visit('/login')
    ->fill('email', $user->email)
    ->fill('password', '123456789')
    ->click('@login-btn')
    ->assertPathIs('/');

    $this->assertAuthenticated();

});

it('It Logout a User', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

  visit('/')
    ->click('@logout');

    $this->assertGuest();

});

it('Requires a valid email', function () {

  visit('/register')
    ->fill('name', 'John Doe')
    ->fill('email', 'john123')
    ->fill('password', '123456789')
    // ->debug();
    ->click('@register-btn')
    ->assertPathIs('/register');
    // ->assertSee('the email must be valid email address');
});
