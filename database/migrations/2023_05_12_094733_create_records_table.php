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
        Schema::create('records', function (Blueprint $table) {
            $table->bigIncrements('record_id');
            $table->unsignedBigInteger('p_id');
            $table->string('r_reference');
            $table->date('date');
            $table->time('time');
            $table->string('weather');
            $table->bigInteger('temperature');
            $table->string('other_involved_party')->nullable();
            $table->string('performed_services');
            $table->string('equipments_materials');
            $table->string('other_events')->nullable();
            $table->string('notes')->nullable();

            $table->foreign('p_id')->references('project_id')->on('projects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('records');
    }
};
