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
        Schema::create('users', function (Blueprint $table) {
            $table->bigincrements('user_id');
            $table->unsignedBigInteger('c_id');
            $table->string('u_first_name');
            $table->string('u_surname');
            $table->string('username');
            $table->string('u_email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('u_telefon');
            $table->string('password');
            $table->boolean('is_admin')->default(true);
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('c_id')->references('company_id')->on('companies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
