<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCargoTypeToShipTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ship_types', function (Blueprint $table) {
            $table->boolean('cargo_type')->after('tonaj_type')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ship_types', function (Blueprint $table) {
            $table->dropColumn('cargo_type');
        });
    }
}
