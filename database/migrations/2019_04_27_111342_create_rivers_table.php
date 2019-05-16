<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRiversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rivers', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->timestamps();
        });

        $this->seedTypes();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rivers');
    }

    private function seedTypes(){
        $types = array(
            ['id' =>1],
            ['id' =>2],
            ['id' =>3],
            ['id' =>4],
            ['id' =>5],
            ['id' =>6],
            ['id' =>7],
            ['id' =>8],
            ['id' =>9],
            ['id' =>10],
            ['id' =>11],


        );

        DB::table('rivers')->insert($types);
    }

}
