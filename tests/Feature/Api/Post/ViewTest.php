<?php

use App\Models\User;

describe('View Post', function () {
    it('can view a published post', function () {
        $this->get('/api/v1/posts/' . 1,  ['accept' => 'application/vnd.api+json'])
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'type' => 'posts',
                    'id' => 1,
                ],
            ]);
    });

    it('cannot view an unpublished post as a guest', function () {
        $this->get('/api/v1/posts/' . 2, ['accept' => 'application/vnd.api+json'])
            ->assertStatus(401);
    });

    it('cannot view an unpublished post as a user', function () {
        $this->actingAs(User::firstWhere('id', 2))->get('/api/v1/posts/' . 2, ['accept' => 'application/vnd.api+json'])
            ->assertStatus(403);
    });

    it('can view an unpublished post as the author', function () {
        $this->actingAs(User::first())->get('/api/v1/posts/' . 1, ['accept' => 'application/vnd.api+json'])
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'type' => 'posts',
                    'id' => 1,
                ],
            ]);
    });
});