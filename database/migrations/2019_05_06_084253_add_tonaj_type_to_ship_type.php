<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTonajTypeToShipType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ship_types', function (Blueprint $table) {
            $table->integer('tonaj_type')->after('id');
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
        Schema::table('ship_types', function (Blueprint $table) {
            $table->dropColumn('tonaj_type');
        });
    }
    private function seedTypes(){
        $types = array(
            ['id' => 1 ,'tonaj_type' => 1 ],
            ['id' => 2 ,'tonaj_type' => 1 ],
            ['id' => 3 ,'tonaj_type' => 1 ],
            ['id' => 4 ,'tonaj_type' => 1 ],
            ['id' => 5 ,'tonaj_type' => 2 ],
            ['id' => 6 ,'tonaj_type' => 3 ],
            ['id' => 7 ,'tonaj_type' => 1 ],
            ['id' => 8 ,'tonaj_type' => 1 ],
            ['id' => 9 ,'tonaj_type' => 3 ],
            ['id' => 10 ,'tonaj_type' => 2 ],
            ['id' => 11 ,'tonaj_type' => 1 ],
            ['id' => 12 ,'tonaj_type' => 3 ],
            ['id' => 13 ,'tonaj_type' => 4 ],
            ['id' => 14 ,'tonaj_type' => 3 ],
            ['id' => 15 ,'tonaj_type' => 3 ],
            ['id' => 16 ,'tonaj_type' => 1 ],
            ['id' => 17 ,'tonaj_type' => 1 ],
            ['id' => 18 ,'tonaj_type' => 1 ],
            ['id' => 19 ,'tonaj_type' => 3 ],
            ['id' => 20 ,'tonaj_type' => 3 ],
            ['id' => 21 ,'tonaj_type' => 3 ],
            ['id' => 22 ,'tonaj_type' => 3 ],
            ['id' => 23 ,'tonaj_type' => 5 ],
            ['id' => 24 ,'tonaj_type' => 3 ],
            ['id' => 25 ,'tonaj_type' => 1 ],
            ['id' => 26 ,'tonaj_type' => 3 ],
            ['id' => 27 ,'tonaj_type' => 1 ],
            ['id' => 28 ,'tonaj_type' => 3 ],
            ['id' => 29 ,'tonaj_type' => 1 ],
            ['id' => 30 ,'tonaj_type' => 1 ],
            ['id' => 31 ,'tonaj_type' => 1 ]
        );

        foreach ($types as $type){
            $mata = \App\Models\Common\ShipType::find($type['id']);
            $mata->tonaj_type = $type['tonaj_type'];
            $mata->update();
        }
       return;
    }
}
