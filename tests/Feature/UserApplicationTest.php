<?php

use App\Models\User;
use App\Models\Application;
use function Pest\Laravel\actingAs;

it('allows users to access tasks page', function () {
    $user = User::factory()->create();

    actingAs($user)
        ->get(route('user.applications.index'))
        ->assertOk();
});

it('does not allow users to access admin task page', function () {
    $user = User::factory()->create();

    actingAs($user)
        ->get(route('admin.applications.index'))
        ->assertForbidden();
});

it('allows administrator to access tasks page', function () {
    $user = User::factory()->create(['is_admin' => true]);

    actingAs($user)
        ->get(route('admin.applications.index'))
        ->assertOk();
});
