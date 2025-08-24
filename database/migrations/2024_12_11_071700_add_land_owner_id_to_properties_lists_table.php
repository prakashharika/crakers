<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('properties_lists', function (Blueprint $table) {
            $table->unsignedBigInteger('land_owner_id')->nullable(); // You can adjust this depending on your requirements.
        });
    }
    
    public function down()
    {
        Schema::table('properties_lists', function (Blueprint $table) {
            $table->dropColumn('land_owner_id');
        });
    }
    
};
