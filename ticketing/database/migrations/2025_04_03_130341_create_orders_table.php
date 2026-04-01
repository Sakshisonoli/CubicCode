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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('ticket_id')->nullable();
            $table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('cascade');
            $table->unsignedBigInteger('bid_id')->nullable();
            $table->foreign('bid_id')->references('id')->on('bidings')->onDelete('cascade');
            $table->decimal('ticket_price', 19, 2)->nullable();
            $table->integer('no_of_tickets')->nullable();
            $table->decimal('total_price', 19, 2)->nullable();
            $table->decimal('gst', 10, 2)->nullable();
            $table->decimal('discount', 19, 2)->nullable();
            $table->string('mode')->nullable();
            $table->string('payment_id')->nullable();
            $table->string('status')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
