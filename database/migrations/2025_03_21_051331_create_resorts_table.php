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
            $table->string('slug')->unique();
            $table->foreignId('country_id')->constrained()->onDelete('cascade');
            $table->foreignId('town_id')->nullable()->constrained()->after('country_id');
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->integer('base_elevation')->nullable();
            $table->date('start')->nullable();
            $table->date('end')->nullable();
            $table->string('image_url')->nullable();
            $table->string('state')->nullable();
            $table->string('state_code')->nullable();
            $table->string('timezone')->nullable();
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




/**

* Country belongsTo - Continent
* Country hasMany - States, Towns, Resorts

* State belongTo - Country
* State hasMany - Towns, Resorts

* Town belongsTo - State, Country
* Town hasMany - Resorts, Suburbs, Companies,

* Resort belongsTo - Country, State, Town
* Resort hasMany -


*/
