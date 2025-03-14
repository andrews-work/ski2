<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('resort_topics', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('resort_id');
            $table->unsignedBigInteger('topic_id');
            $table->timestamps();

            $table->foreign('resort_id')->references('id')->on('category_list')->onDelete('cascade');
            $table->foreign('topic_id')->references('id')->on('topics')->onDelete('cascade');

            $table->unique(['resort_id', 'topic_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('resort_topics');
    }
};
