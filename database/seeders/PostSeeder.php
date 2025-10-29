<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $author = User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ]);

        $commenter = User::create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ]);

        $tag1 = Tag::create(['name' => 'Laravel']);
        $tag2 = Tag::create(['name' => 'JSON:API']);

        $post = new Post([
            'published_at' => now(),
            'slug' => 'my-first-post',
            'title' => 'My First Post',
            'content' => 'This is the content of my first post.',
        ]);
        $post->author()->associate($author)->save();
        $post->tags()->saveMany([$tag1, $tag2]);

        $comment = new Comment([
            'content' => 'Great post!',
        ]);
        $comment->post()->associate($post);
        $comment->author()->associate($commenter);
        $comment->save();

        $post = new Post([
            'slug' => 'my-second-post',
            'title' => 'My Second Post',
            'content' => 'This is the content of my second post.',
        ]);
        $post->author()->associate($author)->save();
    }
}
