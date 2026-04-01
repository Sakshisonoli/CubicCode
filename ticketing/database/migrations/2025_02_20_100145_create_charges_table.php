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
        Schema::create('charges', function (Blueprint $table) {
            $table->id();
            $table->decimal('min_amt', 19, 2)->nullable();
            $table->decimal('max_amt', 19, 2)->nullable();
            $table->decimal('charges', 19, 2)->nullable();
            $table->text('note')->nullable();
            $table->string('category')->nullable();
            $table->string('count')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('charges');
    }
};
