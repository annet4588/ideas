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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->contrained()->cascadeOnDelete();
            //idea_id
            //content
            $table->foreignId('idea_id')->contrained()->cascadeOnDelete();
            $table->string('content');
            $table->timestamps();

            //updated_at
            //edited_at etc


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
