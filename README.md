# Laravel JSON:API Demo

## Overview

This project demonstrates the implementation of JSON:API specification on Laravel framework, showcasing a blog-style API that handles posts, comments, tags, and user authentication. It leverages Laravel Sanctum for API authentication and follows the [JSON:API specification](https://jsonapi.org/) using the [Laravel JSON:API](https://laraveljsonapi.io/) package.

> the demo was created by following the [Laravel JSON:API Tutorial](https://laraveljsonapi.io/5.x/tutorial/)

## Features

- Authentication with Laravel Sanctum
- Blog Posts Management
- Comments System
- Tags Support
- Author Management
- JSON:API Compliant Responses
- Relationship Management

## Requirements

- PHP 8.4+
- Laravel 12.x
- Composer
- Database (MySQL, PostgreSQL, or SQLite)

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/ryoadi/laravel-jsonapi-demo.git
   cd laravel-jsonapi-demo
   ```

2. Setup the project:
   ```bash
   composer setup
   ```
   This will install all dependencies, set up your environment, generate key, and run migrations.

3. Configure database in `.env` if needed (SQLite is configured by default)

## API Documentation

### Authentication

To authenticate API requests:

1. Create a personal access token:
   ```bash
   # First, create a user if you haven't
   php artisan tinker
   >>> $user = \App\Models\User::factory()->create()
   >>> $token = $user->createToken('api-token')
   >>> $token->plainTextToken # Copy this token
   ```

   Or use the seeded user if available:
   ```bash
   php artisan tinker
   >>> $user = \App\Models\User::first()
   >>> $token = $user->createToken('api-token')
   >>> $token->plainTextToken # Copy this token
   ```

2. Include token in Authorization header:
   ```
   Authorization: Bearer your-token-here
   ```

### Posts

Endpoint: `/api/v1/posts`

- `GET /api/v1/posts` - List all posts
- `GET /api/v1/posts/{id}` - Get specific post
- `POST /api/v1/posts` - Create new post
- `PATCH /api/v1/posts/{id}` - Update post
- `DELETE /api/v1/posts/{id}` - Delete post

Relationships:
- `author` - The post's author (read-only)
- `comments` - Post's comments (read-only)
- `tags` - Post's tags (readable and modifiable)

### Comments

Comments are accessible through post relationships:

- `GET /api/v1/posts/{id}/comments` - List post comments
- `GET /api/v1/posts/{id}/relationships/comments` - Get comment relationships

### Tags

Tags can be managed through post relationships:

- `GET /api/v1/posts/{id}/tags` - List post tags
- `POST /api/v1/posts/{id}/relationships/tags` - Add tags to post
- `PATCH /api/v1/posts/{id}/relationships/tags` - Update post tags
- `DELETE /api/v1/posts/{id}/relationships/tags` - Remove tags from post

### Authors

Authors are accessible through post relationships:

- `GET /api/v1/posts/{id}/author` - Get post author
- `GET /api/v1/posts/{id}/relationships/author` - Get author relationship

## Try it with Postman

1. Download and install [Postman](https://www.postman.com/downloads/)

2. Create a new collection in Postman

3. Set up environment variables:
   - Create a new environment
   - Add variables:
     - `base_url`: `http://localhost:8000/api/v1`
     - `token`: Your authentication token (from the Authentication section)

4. Example requests:
   - List posts:
     - Method: GET
     - URL: `{{base_url}}/posts`
     - Headers:
       ```
       Accept: application/vnd.api+json
       Authorization: Bearer {{token}}
       ```

   - Create post:
     - Method: POST
     - URL: `{{base_url}}/posts`
     - Headers:
       ```
       Accept: application/vnd.api+json
       Content-Type: application/vnd.api+json
       Authorization: Bearer {{token}}
       ```
     - Body:
       ```json
       {
         "data": {
           "type": "posts",
           "attributes": {
             "title": "My First Post",
             "content": "This is the content of my first post"
           }
         }
       }
       ```

5. Important Headers:
   - Always include `Accept: application/vnd.api+json` header
   - For POST/PATCH requests, include `Content-Type: application/vnd.api+json`
   - Include `Authorization: Bearer your-token` for authenticated endpoints

## Development

To start the development server:

```bash
composer dev
```

This will start:
- Laravel development server
- Queue worker
- Log viewer
- Vite for frontend assets

The API will be available at `http://localhost:8000/api/v1/`
