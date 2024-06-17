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
            /* Columnas */
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->mediumText('body')->nullable();
            $table->string('image_path')->nullable();
            $table->boolean('published')->default(0);
            
            /* Llaves foraneas */
            $table->foreignId('user_id')->constrained();
            $table->foreignId('category_id')->constrained();
            
            /* Marcas de tiempo */
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
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
