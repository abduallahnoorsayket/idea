<?php

/**
 * @file
 */

declare(strict_types=1);

use Illuminate\Support\Facades\Auth as FacadesAuth;

/**
 * @file
 */


/**
 * @file
 */

it('It registe a User', function () {
  visit('/register')
    ->fill('name', 'jamal')
    // ->fill('email', fake()->unique()->safeEmail())
    ->fill('email', 'jama@mail.com')
    ->fill('password', '123456789225')
    ->click('@register-btn')
    ->assertPathIs('/');

    $this->assertAuthenticated();
    expect(FacadesAuth::user())->toMatchArray([
      'name' => 'jamal',
      'email' => 'jama@mail.com',
    ]);
});
