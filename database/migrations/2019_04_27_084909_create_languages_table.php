<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('abbr');

            $table->timestamps();
        });

        $this->seedLangs();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('languages');
    }

    private function seedLangs(){
        $langs = array(
            ['id' =>1, 'abbr' =>'en'],
            ['id' =>2, 'abbr' =>'ro'] );


        DB::table('languages')->insert($langs);
    }
}
