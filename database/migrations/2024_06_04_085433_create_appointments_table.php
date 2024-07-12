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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->date('date')->format('d-m-Y');
            $table->time('time')->format('H:i');
            $table->integer('duration')->default(60);
            $table->string('comment')->nullable();
            $table->foreignId('employee_id')->constrained('users');
            $table->foreignId('customer_id')->constrained('users');
            $table->string('status')->default('Pending')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
