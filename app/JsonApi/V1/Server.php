<?php

namespace App\JsonApi\V1;

use App\Models\Post;
use Auth;
use LaravelJsonApi\Core\Server\Server as BaseServer;

class Server extends BaseServer
{

    /**
     * The base URI namespace for this server.
     *
     * @var string
     */
    protected string $baseUri = '/api/v1';

    /**
     * Bootstrap the server when it is handling an HTTP request.
     *
     * @return void
     */
    public function serving(): void
    {
        Auth::shouldUse('sanctum');
        Post::creating(static function (Post $post) {
            $post->author()->associate(auth()->user());
        });
    }

    /**
     * Get the server's list of schemas.
     *
     * @return array
     */
    protected function allSchemas(): array
    {
        return [
            Posts\PostSchema::class,
            Comments\CommentSchema::class,
            Users\UserSchema::class,
            Tags\TagSchema::class,
        ];
    }
}
