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
            $table->engine = 'MyISAM';
            $table->bigIncrements('id');
            $table->bigInteger('company_id')->nullable();
            $table->string('role', 6);
            $table->string('name', 255);
            $table->string('username', 255)->unique();
            $table->string('email', 255)->unique();
            $table->string('password', 255);
            $table->string('is_active', 3);
            $table->timestamps();
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
