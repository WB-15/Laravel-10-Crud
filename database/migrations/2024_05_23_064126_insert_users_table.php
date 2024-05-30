<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        User::insert([
            [
                'username' => 'Ben',
                'nickname' => 'Bell',
                'password' => Hash::make('123456'),    
                'created_at' => \Carbon\Carbon::now(), 
                'updated_at' => \Carbon\Carbon::now()
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
