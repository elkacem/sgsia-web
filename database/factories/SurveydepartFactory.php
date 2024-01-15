<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Surveydepart>
 */
class SurveydepartFactory extends Factory
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
            
            'terminal'              => $this-> faker-> randomElement(['Terminal Ouest', 'Terminal 1', 'Terminal 2']),
            'company'              => $this-> faker-> randomElement(['air algérie',
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
                                                                    'vueling']),

            'chariot_disp'         => $this-> faker-> randomElement(['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']),
            'chariot_qualite'      => $this-> faker-> randomElement(['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']),
            'hall_confort'         => $this-> faker-> randomElement(['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']),
            'hall_qualite'         => $this-> faker-> randomElement(['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']),
            'hall_sonore'          => $this-> faker-> randomElement(['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']),
            'info_orie_agents'     => $this-> faker-> randomElement(['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']),
            'info_orie_qualite'    => $this-> faker-> randomElement(['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']),
            'zone_confort_s'       => $this-> faker-> randomElement(['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']),
            'zone_qualite'         => $this-> faker-> randomElement(['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']),
            'zone_sonore'          => $this-> faker-> randomElement(['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']),
            'confort_hall'         => $this-> faker-> randomElement(['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']),
            'confort_zone'         => $this-> faker-> randomElement(['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']),
            'signalisation_parking' => $this-> faker-> randomElement(['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']),
            'signalisation_chariot' => $this-> faker-> randomElement(['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']),
            
            'suggestion' => $this-> faker-> sentence(20),
            'created_at' => $this-> faker-> dateTimeBetween('-30 days', now())
        ];
    }
}
