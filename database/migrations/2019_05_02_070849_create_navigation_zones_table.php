<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNavigationZonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('navigation_zones', function (Blueprint $table) {
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
        Schema::dropIfExists('navigation_zones');
    }

    private function seedTypes(){
        $types = array(
            ['id' =>1],
            ['id' =>2],
            ['id' =>3],


        );

        DB::table('navigation_zones')->insert($types);
    }
}
