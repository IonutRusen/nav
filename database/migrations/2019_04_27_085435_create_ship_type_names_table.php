<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShipTypeNamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ship_type_names', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ship_type')->references('id')->on('ship_types');
            $table->string('name');
            $table->unsignedBigInteger('language_id')->references('id')->on('languages');
            $table->timestamps();
        });

        $this->seedNameRO();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ship_type_names');
    }

    private function seedNameRo(){
        $names = array(
            ['id' =>1, 'name' =>'Bac de trecere', 'ship_type' => '1', 'language_id' => '2'],
            ['id' =>2, 'name' =>'Barja nepropulsata', 'ship_type' => '2', 'language_id' => '2'],
            ['id' =>3, 'name' =>'Barja Ro Ro transport autoturisme', 'ship_type' => '3', 'language_id' => '2'],
            ['id' =>4, 'name' =>'Convoi barje fluviale', 'ship_type' => '4', 'language_id' => '2'],
            ['id' =>5, 'name' =>'Doc plutitor', 'ship_type' => '5', 'language_id' => '2'],
            ['id' =>6, 'name' =>'Draga', 'ship_type' => '6', 'language_id' => '2'],
            ['id' =>7, 'name' =>'Feryboat', 'ship_type' => '7', 'language_id' => '2'],
            ['id' =>8, 'name' =>'Gabara', 'ship_type' => '8', 'language_id' => '2'],
            ['id' =>9, 'name' =>'Împingator', 'ship_type' => '9', 'language_id' => '2'],
            ['id' =>10, 'name' =>'Macara plutitoare', 'ship_type' => '10', 'language_id' => '2'],
            ['id' =>11, 'name' =>'Mineralier', 'ship_type' => '11', 'language_id' => '2'],
            ['id' =>12, 'name' =>'Nava de cercetare', 'ship_type' => '12', 'language_id' => '2'],
            ['id' =>13, 'name' =>'Nava de pasageri', 'ship_type' => '13', 'language_id' => '2'],
            ['id' =>14, 'name' =>'Nava pentru aprovizionare', 'ship_type' => '14', 'language_id' => '2'],
            ['id' =>15, 'name' =>'Nava pentru introdus cabluri submarine', 'ship_type' => '15', 'language_id' => '2'],
            ['id' =>16, 'name' =>'Nava pentru transport animale', 'ship_type' => '16', 'language_id' => '2'],
            ['id' =>17, 'name' =>'Nava pentru transport barje', 'ship_type' => '17', 'language_id' => '2'],
            ['id' =>18, 'name' =>'Nava tanc', 'ship_type' => '18', 'language_id' => '2'],
            ['id' =>19, 'name' =>'Pescador', 'ship_type' => '19', 'language_id' => '2'],
            ['id' =>20, 'name' =>'Pilotina', 'ship_type' => '20', 'language_id' => '2'],
            ['id' =>21, 'name' =>'Platforma petroliera de foraj marin', 'ship_type' => '21', 'language_id' => '2'],
            ['id' =>22, 'name' =>'Ponton acostare', 'ship_type' => '22', 'language_id' => '2'],
            ['id' =>23, 'name' =>'Ponton dormitor', 'ship_type' => '23', 'language_id' => '2'],
            ['id' =>24, 'name' =>'Remorcher', 'ship_type' => '24', 'language_id' => '2'],
            ['id' =>25, 'name' =>'Salanda dragaj', 'ship_type' => '25', 'language_id' => '2'],
            ['id' =>26, 'name' =>'Salupa', 'ship_type' => '26', 'language_id' => '2'],
            ['id' =>27, 'name' =>'Slep nepropulsat', 'ship_type' => '27', 'language_id' => '2'],
            ['id' =>28, 'name' =>'Soneta pentru batut piloni', 'ship_type' => '28', 'language_id' => '2'],
            ['id' =>29, 'name' =>'Transcontainer', 'ship_type' => '29', 'language_id' => '2'],
            ['id' =>30, 'name' =>'Transport animalier', 'ship_type' => '30', 'language_id' => '2'],
            ['id' =>31, 'name' =>'Vrachier', 'ship_type' => '31', 'language_id' => '2']
        );


        DB::table('ship_type_names')->insert($names);
    }
}
