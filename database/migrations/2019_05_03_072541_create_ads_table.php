<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('image_folder');
            $table->unsignedBigInteger('owner_id')->references('id')->on('users');
            $table->unsignedBigInteger('ship_type')->references('id')->on('ship_types');
            $table->string('ship_name');
            $table->string('imo');
            $table->unsignedBigInteger('country_id')->references('id')->on('countries');
            $table->unsignedInteger('made_year');
            $table->unsignedInteger('capacity');
            $table->unsignedInteger('navigation_zone')->references('id')->on('navigation_zones');
            $table->unsignedInteger('length');
            $table->unsignedInteger('width');
            $table->unsignedInteger('height');
            $table->unsignedInteger('draft');
            $table->unsignedInteger('engine_power');
            $table->unsignedBigInteger('cargo_status')->references('id')->on('cargo_statuses')->nullable();
            $table->boolean('cargo_cover')->default(0)->nullable();
            $table->unsignedBigInteger('navigation_regime')->references('id')->on('navigation_regimes');
            $table->boolean('car_crane')->default(0);
            $table->unsignedInteger('crew')->nullable();
            $table->string('owner_name');
            $table->string('owner_email')->nullable();
            $table->string('rivers')->nullable();
            $table->longText('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ads');
    }
}
