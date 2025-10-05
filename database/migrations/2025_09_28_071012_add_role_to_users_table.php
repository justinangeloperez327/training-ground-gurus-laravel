<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('customer');
        });

        // User::create([
        //     'name' => 'Admin',
        //     'email' => 'admin@laravel.com',
        //     'password' => Hash::make('admin'),
        //     'role' => 'admin',
        // ]);

        DB::table('users')
            ->insert([
                'name' => 'Admin',
                'email' => 'admin@laravel.com',
                'password' => Hash::make('admin'),
                'role' => 'admin',
            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};
