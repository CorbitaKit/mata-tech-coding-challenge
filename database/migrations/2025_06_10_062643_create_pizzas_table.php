<?php

use App\Enums\PizzaSize;
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
        Schema::create('pizzas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('slug')->unique();
            $table->foreignId('pizza_type_id');
            $table->enum('size', array_column(PizzaSize::cases(), 'value'));
            $table->decimal('price', 8,2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pizzas');
    }
};
