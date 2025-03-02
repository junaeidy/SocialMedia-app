<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('stories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('image');
            $table->timestamps();
            $table->softDeletes(); // Untuk soft delete
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stories');
    }
};
