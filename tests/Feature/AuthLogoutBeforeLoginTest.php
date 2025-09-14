<?php

use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('admin login logs out existing team session', function () {
    // Create a team member and log them in
    $team = Team::factory()->create(['is_active' => true]);
    $this->actingAs($team, 'team');

    // Verify team is logged in
    expect(auth()->guard('team')->check())->toBeTrue();

    // Create an admin user
    $admin = User::factory()->create();

    // Try to login as admin
    $response = $this->post('/login', [
        'email'    => $admin->email,
        'password' => 'password',
    ]);

    // Should redirect to dashboard
    $response->assertRedirect('/dashboard');

    // Team session should be logged out
    expect(auth()->guard('team')->check())->toBeFalse();

    // Admin should be logged in
    expect(auth()->check())->toBeTrue();
    expect(auth()->user()->id)->toBe($admin->id);
});

test('team login logs out existing admin session', function () {
    // Create an admin user and log them in
    $admin = User::factory()->create();
    $this->actingAs($admin);

    // Verify admin is logged in
    expect(auth()->check())->toBeTrue();

    // Create a team member
    $team = Team::factory()->create(['is_active' => true]);

    // Try to login as team member
    $response = $this->post('/team-login', [
        'email'    => $team->email,
        'password' => 'password',
    ]);

    // Should redirect to team dashboard
    $response->assertRedirect(route('team.dashboard'));

    // Admin session should be logged out
    expect(auth()->check())->toBeFalse();

    // Team should be logged in
    expect(auth()->guard('team')->check())->toBeTrue();
    expect(auth()->guard('team')->user()->id)->toBe($team->id);
});

test('admin login logs out existing admin session', function () {
    // Create first admin and log them in
    $admin1 = User::factory()->create();
    $this->actingAs($admin1);

    // Verify first admin is logged in
    expect(auth()->check())->toBeTrue();
    expect(auth()->user()->id)->toBe($admin1->id);

    // Create second admin
    $admin2 = User::factory()->create();

    // Try to login as second admin
    $response = $this->post('/login', [
        'email'    => $admin2->email,
        'password' => 'password',
    ]);

    // Should redirect to dashboard
    $response->assertRedirect('/dashboard');

    // Second admin should be logged in
    expect(auth()->check())->toBeTrue();
    expect(auth()->user()->id)->toBe($admin2->id);
});

test('team login logs out existing team session', function () {
    // Create first team member and log them in
    $team1 = Team::factory()->create(['is_active' => true]);
    $this->actingAs($team1, 'team');

    // Verify first team member is logged in
    expect(auth()->guard('team')->check())->toBeTrue();
    expect(auth()->guard('team')->user()->id)->toBe($team1->id);

    // Create second team member
    $team2 = Team::factory()->create(['is_active' => true]);

    // Try to login as second team member
    $response = $this->post('/team-login', [
        'email'    => $team2->email,
        'password' => 'password',
    ]);

    // Should redirect to team dashboard
    $response->assertRedirect(route('team.dashboard'));

    // Second team member should be logged in
    expect(auth()->guard('team')->check())->toBeTrue();
    expect(auth()->guard('team')->user()->id)->toBe($team2->id);
});
