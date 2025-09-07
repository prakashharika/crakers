<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSlugToPropertiesTable extends Migration
{
    public function up()
    {
        Schema::table('properties', function (Blueprint $table) {
            if (!Schema::hasColumn('properties', 'slug')) {
                $table->string('slug')->after('tamil_name');
            }
        });
    }

    public function down()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }

}

