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
        Schema::create('fees', function (Blueprint $table) {
            $table->id();
            $table->string('student_name');
            $table->unsignedBigInteger('student_id')->nullable();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->unsignedBigInteger('course_id')->nullable();
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->string('payment_type')->nullable();
            $table->string('payment_mode')->nullable();
            $table->integer('course_amount')->nullable();
            $table->integer('amount_paid')->nullable();
            $table->integer('amount_due')->nullable();
            $table->string('total_installments')->nullable();
            $table->string('installment_count')->nullable();
            $table->date('installment_date')->nullable();
            $table->date('next_installment_date')->nullable();
            $table->integer('next_installment_amount')->nullable();
            $table->string('ins_status')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('service_charge')->nullable();
            $table->string('paid_to_branch')->nullable();
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->foreign('branch_id')->references('id')->on('users')->onDelete('cascade');
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fees');
    }
};
