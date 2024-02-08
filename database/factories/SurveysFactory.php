<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Surveys>
 */
class SurveysFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),

            'status'                => $this-> faker-> randomElement(['depart', 'arrivee']),
            'terminal'              => $this-> faker-> randomElement(['Terminal Ouest', 'Terminal 1', 'Terminal 2']),
            'parking_stationnement' => $this-> faker-> randomElement(['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']),
            'parking_espace_v'      => $this-> faker-> randomElement(['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']),
            'parking_ap_t'          => $this-> faker-> randomElement(['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']),
            'hall_public'           => $this-> faker-> randomElement(['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']),
            'hall_escalier'         => $this-> faker-> randomElement(['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']),
            'hall_escalator'        => $this-> faker-> randomElement(['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']),
            'hall_ascenceur'        => $this-> faker-> randomElement(['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']),
            'hall_facade_v'         => $this-> faker-> randomElement(['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']),
            'hall_chariot'          => $this-> faker-> randomElement(['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']),
            'hall_siege'            => $this-> faker-> randomElement(['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']),
            'toilette_sol'          => $this-> faker-> randomElement(['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']),
            'toilette_lavabo_r'     => $this-> faker-> randomElement(['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']),
            'toilette_cuvette'      => $this-> faker-> randomElement(['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']),
            'toilette_miroir'       => $this-> faker-> randomElement(['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']),
            'toilette_urinoir'      => $this-> faker-> randomElement(['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']),
            'toilette_savon_l'      => $this-> faker-> randomElement(['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']),
            'toilette_papier_h'     => $this-> faker-> randomElement(['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']),
            'salle_emb_lieux'       => $this-> faker-> randomElement(['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']),
            'salle_emb_siege'       => $this-> faker-> randomElement(['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']),
            'salle_emb_facade_v'    => $this-> faker-> randomElement(['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']),
            'passerelle_sol'        => $this-> faker-> randomElement(['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']),
            'passerelle_vitre'      => $this-> faker-> randomElement(['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']),
            'passerelle_bus'        => $this-> faker-> randomElement(['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']),
            'bagage_lieux'          => $this-> faker-> randomElement(['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']),
            'bagage_tapis'          => $this-> faker-> randomElement(['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']),
            'bagage_chariot'        => $this-> faker-> randomElement(['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']),
            'salle_priere'          => $this-> faker-> randomElement(['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']),
            'poubelle'              => $this-> faker-> randomElement(['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']),

            'suggestion' => $this-> faker-> sentence(20),
            'created_at' => $this-> faker-> dateTimeBetween('-1 months', now())
        ];
    }
}
