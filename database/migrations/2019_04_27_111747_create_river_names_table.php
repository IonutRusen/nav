<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRiverNamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('river_names', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('river_id')->references('id')->on('rivers');
            $table->string('name');
            $table->unsignedBigInteger('language_id')->references('id')->on('languages');
            $table->timestamps();

        });

        $this->seedRivers();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('river_names');
    }

    private function seedRivers(){
        $rivers = array(
            ['id' =>1,'river_id' => '1', 'name' =>'Rhin','language_id' => 2 ],
            ['id' =>2,'river_id' => '2', 'name' =>'Dunare','language_id' => 2 ],
            ['id' =>3,'river_id' => '3', 'name' =>'Main','language_id' => 2 ],
            ['id' =>4,'river_id' => '4', 'name' =>'Donau Canal','language_id' => 2 ],
            ['id' =>5,'river_id' => '5', 'name' =>'Sena','language_id' => 2 ],
            ['id' =>6,'river_id' => '6', 'name' =>'Sava','language_id' => 2 ],
            ['id' =>7,'river_id' => '7', 'name' =>'Tisa','language_id' => 2 ],
            ['id' =>8,'river_id' => '8', 'name' =>'Canale Franta','language_id' => 2 ],
            ['id' =>9,'river_id' => '9', 'name' =>'Canale Olanda','language_id' => 2 ],
            ['id' =>10,'river_id' => '10', 'name' =>'Canale Germania','language_id' => 2 ],
            ['id' =>11,'river_id' => '11', 'name' =>'Canale Belgia','language_id' => 2 ],
            ['id' =>12,'river_id' => '2', 'name' =>'Danube','language_id' => 1 ],


        );


        DB::table('river_names')->insert($rivers );
    }
}
