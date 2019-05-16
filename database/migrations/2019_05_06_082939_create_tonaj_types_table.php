<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTonajTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tonaj_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_ro');
            $table->string('name_en');
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
        Schema::dropIfExists('tonaj_types');
    }

    private function seedNames(){
        $names = array(
            ['id' =>1,'name_ro' => 'Capacitatea maxima de incarcare in tone', 'name_en' =>'Maximum capacity in tonne' ],
            ['id' =>2,'name_ro' => 'Capacitatea maxima de ridicare in tone', 'name_en' =>'Maximum lift capacity in tonnes' ],
            ['id' =>3,'name_ro' => 'Tone deplasament nava', 'name_en' =>'Tone displacement ship' ],
            ['id' =>4,'name_ro' => 'Numarul maxim de pasageri imbarcati', 'name_en' =>'The maximum number of passengers' ],
            ['id' =>5,'name_ro' => 'Numarul maxim de persoane cazate la bord', 'name_en' =>'Maximum number of people accommodated on board' ],
        );


        DB::table('tonaj_types')->insert($names );
    }
}
