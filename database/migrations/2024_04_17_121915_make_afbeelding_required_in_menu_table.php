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
        Schema::table('menu', function (Blueprint $table) {
            // Change the column to not nullable and assume it has a default image path or remove default if not applicable
            $table->string('afbeelding')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('menu', function (Blueprint $table) {
            // Revert back to nullable in case you need to roll back the migration
            $table->string('afbeelding')->nullable()->change();
        });
    }
};
