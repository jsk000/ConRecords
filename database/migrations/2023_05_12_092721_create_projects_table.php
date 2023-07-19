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
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('project_id');
            $table->unsignedBigInteger('c_id');
            $table->unsignedBigInteger('u_id'); //responsible project manager
            $table->string('p_reference');
            $table->string('p_name');
            $table->string('p_street');
            $table->string('p_house_no');
            $table->string('p_postal_code');
            $table->string('p_city');
            $table->string('owner_first_name');
            $table->string('owner_surname');
            $table->string('o_email');
            $table->string('o_telefon');

            $table->foreign('c_id')->references('company_id')->on('companies')->onDelete('cascade');
            $table->foreign('u_id')->references('user_id')->on('users')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
