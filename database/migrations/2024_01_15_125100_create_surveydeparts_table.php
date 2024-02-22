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
        Schema::create('surveydeparts', function (Blueprint $table) {
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

            $table->enum('chariot_disp'          ,['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']);
            $table->enum('chariot_qualite'       ,['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']);
            $table->enum('hall_confort'          ,['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']);
            $table->enum('hall_qualite'          ,['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']);
            $table->enum('hall_sonore'           ,['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']);
            $table->enum('info_orie_agents'       ,['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']);
            $table->enum('info_orie_qualite'      ,['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']);
            $table->enum('zone_confort_s'        ,['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']);
            $table->enum('zone_qualite'          ,['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']);
            $table->enum('zone_sonore'           ,['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']);
            $table->enum('confort_hall'          ,['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']);
            $table->enum('confort_zone'          ,   ['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']);
            $table->enum('signalisation_parking'    ,['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']);
            $table->enum('signalisation_chariot'     ,['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']);
            $table->enum('signalisation_hall'      ,['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']);


            $table->text('suggestion')->nullable();
            $table->integer('status')->default(0)->unsigned();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surveydeparts');
    }
};
