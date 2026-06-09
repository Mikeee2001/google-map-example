<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role', ['admin', 'user'])->default('user');
            $table->rememberToken();
            $table->timestamps();
        });
         DB::table('users')->insert([
            [
                'fullname' => 'admin',
                'email' => 'admin@gmail.com',
                'role' => 'admin',
                'password' => '$2y$12$8qGbpTMe/NFXUMNZbMB5Gu0SFlp/hOcbGb6yyhSdn6MxedBmK7Eta', // hashed password
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'fullname' => 'Juan Dela Cruz',
                'email' => 'patient@gmail.com',
                'role' => 'user',
                'password' => '$2y$12$8qGbpTMe/NFXUMNZbMB5Gu0SFlp/hOcbGb6yyhSdn6MxedBmK7Eta', // hashed password
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'fullname' => 'Willie Ong',
                'email' => 'dentist@gmail.com',
                'role' => 'user',
                'password' => '$2y$12$8qGbpTMe/NFXUMNZbMB5Gu0SFlp/hOcbGb6yyhSdn6MxedBmK7Eta', // hashed password
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'fullname' => 'Jose Rizal',
                'email' => 'patient2@gmail.com',
                'role' => 'admin',
                'password' => '$2y$12$8qGbpTMe/NFXUMNZbMB5Gu0SFlp/hOcbGb6yyhSdn6MxedBmK7Eta', // hashed password
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
