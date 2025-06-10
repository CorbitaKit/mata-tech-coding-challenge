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
        Schema::create('ingredient_pizza_types', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('pizza_type_id');
            $table->foreignId('ingredient_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingredient_pizza_types');
    }
};
