<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id')->nullable()
                ->constrained('users')->cascadeOnUpdate()->nullOnDelete();
            $table->timestamps();
            $table->timestamp('published_at')->nullable();
            $table->string('slug')->unique();
            $table->string('title');
            $table->text('content');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
