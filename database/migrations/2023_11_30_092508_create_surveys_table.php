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
        Schema::create('surveys', function (Blueprint $table) {

            $table->id();
            $table->foreignId('user_id')->constrained();

            $table->enum('status',['depart', 'arrivee']);
            $table->enum('terminal',['Terminal Ouest', 'Terminal 1', 'Terminal 2']);
            
            $table->enum('parking_stationnement',['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']);
            $table->enum('parking_espace_v'     ,['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']);
            $table->enum('parking_ap_t'         ,['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']);
            $table->enum('hall_public'          ,['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']);
            $table->enum('hall_escalier'        ,['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']);
            $table->enum('hall_escalator'       ,['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']);
            $table->enum('hall_ascenceur'       ,['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']);
            $table->enum('hall_facade_v'        ,['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']);
            $table->enum('hall_chariot'         ,['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']);
            $table->enum('hall_siege'           ,['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']);
            $table->enum('toilette_sol'         ,['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']);
            $table->enum('toilette_lavabo_r'    ,['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']);
            $table->enum('toilette_cuvette'     ,['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']);
            $table->enum('toilette_miroir'      ,['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']);
            $table->enum('toilette_urinoir'     ,['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']);
            $table->enum('toilette_savon_l'     ,['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']);
            $table->enum('toilette_papier_h'    ,['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']);

            $table->enum('salle_emb_lieux'      ,['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant'])->nullable();
            $table->enum('salle_emb_siege'      ,['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant'])->nullable();
            $table->enum('salle_emb_facade_v'   ,['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant'])->nullable();
            $table->enum('passerelle_sol'       ,['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant'])->nullable();
            $table->enum('passerelle_vitre'     ,['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant'])->nullable();
            $table->enum('passerelle_bus'       ,['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant'])->nullable();

            $table->enum('bagage_lieux'         ,['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']);
            $table->enum('bagage_tapis'         ,['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']);
            $table->enum('bagage_chariot'       ,['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']);
            $table->enum('salle_priere'         ,['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']);
            $table->enum('poubelle'             ,['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']);
            
            $table->text('suggestion');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surveys');
    }
};
