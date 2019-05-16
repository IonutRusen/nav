<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCargoStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cargo_statuses', function (Blueprint $table) {
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
        Schema::dropIfExists('cargo_statuses');
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


        );

        DB::table('cargo_statuses')->insert($types);
    }
}
