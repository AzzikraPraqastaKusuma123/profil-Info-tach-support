<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('information', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->string('title');
            $table->text('excerpt');
            $table->string('date');
            $table->string('author');
            $table->string('read_time');
            $table->text('content')->nullable(); // nullable content field
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('information');
    }
};
