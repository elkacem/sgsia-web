<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('passager_arrives', function (Blueprint $table) {

            $table->id();
            $table->foreignId('user_id')->constrained();

            $table->enum('terminal',['Terminal Ouest', 'Terminal 1', 'Terminal 2']);
            $table->enum('company',['air algérie',
                'tassili airlines',
                'asl airlines',
                'air canada',
                'air france',
                'ita airways',
                'british airways',
                'nouvelair',
                'emirates',
                'iberia',
                'lufthansa',
                'egyptair',
                'qatar airways',
                'syrianair',
                'royal jordanian',
                'saudia airabian airlines',
                'jetairfly',
                'turkish airlines',
                'transavia',
                'tunisair',
                'volotea',
                'vueling']);

            $table->enum('hall_qlt_aff'          ,['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']);
            $table->enum('bagage_temp_att'       ,['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']);
            $table->enum('chariot_disp'          ,['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']);
            $table->enum('chariot_qlt'          ,['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']);
            $table->enum('confort_climatique'   ,['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']);
            $table->enum('sign_parking'         ,['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']);
            $table->enum('sign_chariot'         ,['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']);
            $table->enum('sign_hall'            ,['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']);


            $table->text('suggestion')->nullable();
            $table->integer('status')->default(1)->unsigned();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('passager_arrives');
    }
};
