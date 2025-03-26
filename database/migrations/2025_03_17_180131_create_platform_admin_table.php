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
        Schema::create('platform_admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps(); 
        });

        // Insert the hardcoded Super Admin
        \Illuminate\Support\Facades\DB::table('platform_admins')->insert([
            [
                'name' => 'Platform Admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('superadmin123'), // Change in production
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('platform_admin');
    }
};
