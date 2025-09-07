<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('buyers', function (Blueprint $table) {
            // Add address field (nullable string)
            $table->string('address')->nullable()->after('email');

            // Add password field (required for authentication)
            $table->string('password')->after('address');

            // Optional: Add remember token for "remember me" functionality
            $table->rememberToken()->after('password');

            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('buyers', function (Blueprint $table) {
            $table->dropColumn(['address', 'password']);
        });
    }
};
