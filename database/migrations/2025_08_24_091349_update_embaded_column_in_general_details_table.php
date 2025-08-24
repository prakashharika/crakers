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
        Schema::table('general_details', function (Blueprint $table) {
            // Change 'embaded' column to TEXT (or LONGTEXT if needed)
            $table->text('embaded')->change();
        });
    }

    public function down()
    {
        Schema::table('general_details', function (Blueprint $table) {
            // Revert to previous size if known. Let's assume it was string(255)
            $table->string('embaded', 255)->change();
        });
    }
};
