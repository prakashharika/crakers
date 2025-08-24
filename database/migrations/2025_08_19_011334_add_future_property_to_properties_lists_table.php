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
        $table->boolean('future_property')->default(0)->after('status')->nullable();
    });
}

public function down()
{
    Schema::table('properties_lists', function (Blueprint $table) {
        $table->dropColumn('future_property');
    });
}
};
