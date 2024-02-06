<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PassagerArrive>
 */
class PassagerArriveFactory extends Factory
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

            'hall_qlt_aff'          => $this-> faker-> randomElement(['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']),
            'bagage_temp_att'       => $this-> faker-> randomElement(['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']),
            'chariot_disp'          => $this-> faker-> randomElement(['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']),
            'chariot_qlt'           => $this-> faker-> randomElement(['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']),
            'confort_climatique'    => $this-> faker-> randomElement(['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']),
            'sign_parking'          => $this-> faker-> randomElement(['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']),
            'sign_chariot'          => $this-> faker-> randomElement(['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']),
            'sign_hall'             => $this-> faker-> randomElement(['Satisfaisant', 'Moyennement Satisfaisant', 'Non Satisfaisant']),

            'suggestion' => $this-> faker-> sentence(20),
            'created_at' => $this-> faker-> dateTimeBetween('-30 days', now())

        ];
    }
}
