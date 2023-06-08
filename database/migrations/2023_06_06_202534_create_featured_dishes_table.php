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
        Schema::create('featured_dishes', function (Blueprint $table) {
            $table->primary(['featured_id', 'dish_id']);

            $table->foreignId('featured_id')->constrained('featureds')
            ->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('dish_id')->constrained('dishes')
            ->onUpdate('cascade')->onDelete('restrict');

            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('featured_dishes');
    }
};
