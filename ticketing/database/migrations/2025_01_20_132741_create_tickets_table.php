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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_name')->nullable();
            $table->unsignedBigInteger('event_id')->nullable();
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->unsignedBigInteger('seat_id')->nullable();
            $table->foreign('seat_id')->references('id')->on('seats')->onDelete('cascade');
            $table->integer('number_of_tickets')->nullable();
            $table->json('seat_numbers')->nullable();
            $table->decimal('min_price', 19, 2)->nullable();
            $table->decimal('max_price', 19, 2)->nullable();
            $table->decimal('total_min_price', 19, 2)->nullable();
            $table->decimal('total_max_price', 19, 2)->nullable();
            $table->string('sell_type')->nullable();
            $table->json('features')->nullable();
            $table->json('comments')->nullable();
            $table->json('restrictions')->nullable();
            $table->json('limitations')->nullable();
            $table->unsignedBigInteger('owner_id')->nullable();
            $table->foreign('owner_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('purchaser_id')->nullable();
            $table->foreign('purchaser_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('biding_status')->nullable();
            $table->decimal('min_bid_price', 19, 2)->nullable();
            $table->decimal('max_bid_price', 19, 2)->nullable();
            $table->string('payment_status')->nullable();
            $table->string('download_status')->nullable();
            $table->string('ticket_image1')->nullable();
            $table->string('ticket_image2')->nullable();
            $table->string('status')->nullable();
            $table->string('rating')->nullable();
            $table->string('about_you')->nullable();
            $table->string('listing_type')->nullable();
            $table->string('delivery_type')->nullable();
            $table->text('about_ticket')->nullable();
            $table->string('t_and_c_status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
