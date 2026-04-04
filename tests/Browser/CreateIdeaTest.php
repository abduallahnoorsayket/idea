<?php

/**
 * @file
 * Browser test for idea creation functionality.
 */

use App\Models\User;

it('creates a new idea', function () {
    $user = User::factory()->create();

    visit('/login')
        ->fill('email', $user->email)
        ->fill('password', 'password')
        ->click('@login-btn')
        ->assertPathIs('/ideas')
        ->click('@create-idea-button')
        ->fill('title', 'Some Example Title')
        ->click('@button-status-completed')
        ->fill('description', 'An example description')
        ->fill('@new-link', 'https://laracasts.com')
        ->click('@submit-new-link-button')
        ->fill('@new-link', 'https://laravel.com')
        ->click('@submit-new-link-button')
        ->fill('@new-step', 'Do a thing')
        ->click('@submit-new-link-button')
        ->fill('@new-step', 'Do a new thing')
        ->click('button[type="submit"]')
        ->waitForLocation('/ideas')
        ->assertPathIs('/ideas');

    // 1. Check database directly (Best practice)
    $this->assertDatabaseHas('ideas', [
        'title' => 'Some Example Title',
        'user_id' => $user->id,
    ]);

    // 2. Fetch fresh data for Pest expectations
    $idea = \App\Models\Idea::where('user_id', $user->id)->latest()->first();

    expect($idea)->not->toBeNull();
    expect($idea->toArray())->toMatchArray([
        'title' => 'Some Example Title',
        'status' => 'completed',
        'description' => 'An example description',
    ]);

    expect($user->ideas()->first())->toMatchArray(['title' => 'Some Example Title', 'status' => 'completed', 'description' => 'An example description', 'links' => ['https://laracasts.com', 'https://laravel.com']],
    );

    expect($idea->steps)->toHaveCount(2);
});
