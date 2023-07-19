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
        Schema::create('workers', function (Blueprint $table) {
            $table->bigincrements('worker_id');
            $table->unsignedBigInteger('r_id');
            $table->string('w_first_name');
            $table->string('w_surname');
            $table->time('start_time');
            $table->time('end_time');

            $table->foreign('r_id')->references('record_id')->on('records')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workers');
    }
};
