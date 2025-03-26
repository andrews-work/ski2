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
        Schema::create('resorts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->foreignId('country_id')->constrained()->onDelete('cascade');
            $table->string('wiki_url')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->integer('base_elevation')->nullable();
            $table->integer('peak_elevation')->nullable();
            $table->date('season_start')->nullable();
            $table->date('season_end')->nullable();
            $table->string('image_url')->nullable();
            $table->string('nearest_city')->nullable();
            $table->string('website')->nullable();
            $table->string('skiable_area')->nullable();
            $table->string('lifts')->nullable();
            $table->string('vertical')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resorts');
    }
};
