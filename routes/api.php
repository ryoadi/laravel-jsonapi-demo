<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use LaravelJsonApi\Laravel\Facades\JsonApiRoute;
use LaravelJsonApi\Laravel\Http\Controllers\JsonApiController;
use LaravelJsonApi\Laravel\Routing\Relationships;
use LaravelJsonApi\Laravel\Routing\ResourceRegistrar;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

JsonApiRoute::server('v1')
    ->prefix('v1')
    ->resources(function (ResourceRegistrar $server) {
        $server->resource('posts', JsonApiController::class)
            ->only('index', 'show', 'store', 'update')
            ->relationships(function(Relationships $relationships) {
                $relationships->hasOne('author')->readOnly();
                $relationships->hasMany('comments')->readOnly();
                $relationships->hasMany('tags');
            });
    });