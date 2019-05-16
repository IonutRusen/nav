<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNavigationRegimeNamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('navigation_regime_names', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('regime_id')->references('id')->on('navigation_regimes');
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
        Schema::dropIfExists('navigation_regime_names');
    }

    private function seedNames(){
        $names = array(
            ['id' =>1,'regime_id' => '1', 'name' =>'A1 (06-20)','language_id' => 2 ],
            ['id' =>2,'regime_id' => '2', 'name' =>'A2 (06-23)','language_id' => 2 ],
            ['id' =>3,'regime_id' => '3', 'name' =>'B (navigatie Non Stop)','language_id' => 2 ],




        );


        DB::table('navigation_regime_names')->insert($names );
    }
}
