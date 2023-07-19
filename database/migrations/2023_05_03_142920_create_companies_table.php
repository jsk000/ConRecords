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
        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('company_id');
            $table->string('c_name')->unique();
            $table->string('c_email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('c_telefon');
            $table->string('c_street');
            $table->string('c_house_no');
            $table->string('c_postal_code');
            $table->string('c_city');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
