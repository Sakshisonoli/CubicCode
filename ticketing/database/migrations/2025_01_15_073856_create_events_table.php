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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('event_name');
            $table->string('artist_name');
            $table->text('description')->nullable();
            $table->date('event_date')->nullable();
            $table->string('event_time')->nullable();
            $table->string('event_location')->nullable();
            $table->unsignedBigInteger('stadium_id')->nullable();
            $table->foreign('stadium_id')->references('id')->on('stadia')->onDelete('cascade');
            $table->string('event_stadium')->nullable();
            $table->string('event_photo')->nullable();
            $table->string('status')->nullable();
            $table->string('feature_status')->nullable();
            $table->string('demo')->nullable();
            $table->string('crowd_status')->nullable();
            $table->string('addition')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
