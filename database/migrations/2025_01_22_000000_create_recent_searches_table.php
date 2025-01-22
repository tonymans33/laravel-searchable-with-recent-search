<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('recent_searches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('query');
            $table->nullableMorphs('searchable'); // Adds searchable_type and searchable_id
            $table->timestamp('last_searched_at');
            $table->timestamps();

            $table->unique(['user_id', 'query', 'searchable_type']); // Prevent duplicate searches
        });
    }

    public function down()
    {
        Schema::dropIfExists('recent_searches');
    }
};
