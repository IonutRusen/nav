<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCargoStatusNamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cargo_status_names', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('status_id')->references('id')->on('cargo_statuses');
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
        Schema::dropIfExists('cargo_status_names');
    }

    private function seedNames(){
        $names = array(
            ['id' =>1,'status_id' => '1', 'name' =>'Magazie cu podea metalica','language_id' => 2 ],
            ['id' =>2,'status_id' => '2', 'name' =>'Magazie cu podea de lemn','language_id' => 2 ],
            ['id' =>3,'status_id' => '3', 'name' =>'Magazie cu podea mixta lemn si metal','language_id' => 2 ],
            ['id' =>4,'status_id' => '4', 'name' =>'Tancuri cisterna pentru uleiuri si hidrocarburi','language_id' => 2 ],
            ['id' =>5,'status_id' => '5', 'name' =>'Tancuri cisterna destinate produselor chimice si alimentare','language_id' => 2 ],
            ['id' =>6,'status_id' => '6', 'name' =>'Tancuri cisterna destinate doar produselor chimice','language_id' => 2 ],
            ['id' =>7,'status_id' => '7', 'name' =>'Tancuri cisterna destinate doar produselor alimentare','language_id' => 2 ],



        );


        DB::table('cargo_status_names')->insert($names );
    }
}
