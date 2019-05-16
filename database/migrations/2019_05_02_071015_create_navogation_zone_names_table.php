<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNavogationZoneNamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('navogation_zone_names', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('zone_id')->references('id')->on('navigation_zones');
            $table->string('name');
            $table->unsignedBigInteger('language_id')->references('id')->on('languages');
            $table->timestamps();
        });

        $this->seedNames();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('navogation_zone_names');
    }


    private function seedNames(){
        $names = array(
            ['id' =>1,'zone_id' => '1', 'name' =>'Fluviala','language_id' => 2 ],
            ['id' =>2,'zone_id' => '2', 'name' =>'Fluvial-Maritim','language_id' => 2 ],
            ['id' =>3,'zone_id' => '3', 'name' =>'Maritima','language_id' => 2 ],



        );


        DB::table('navogation_zone_names')->insert($names );
    }
}
