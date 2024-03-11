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
        Schema::create('shifts', function (Blueprint $table) {
            $table->id(); // Define the primary key first
            $table->string('name');
            $table->datetime('start_time');
            $table->datetime('end_time');
            $table->datetime('break_start')->nullable();
            $table->datetime('break_end')->nullable();
            $table->JSON('days');
            $table->timestamps();

            // // Define the foreign key constraint after creating the column
            // $table->foreign('workdays_id')->references('id')->on('workdays_tbl')->onDelete('cascade');

            // $table->timestamps();

            // // Create the index after defining the foreign key
            // $table->index('workdays_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shifts');
    }
};