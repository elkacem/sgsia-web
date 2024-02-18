<?php

namespace App\Http\Controllers;

use App\Models\PassagerArrive;
use App\Models\Surveydepart;
use App\Models\Surveys;
use Carbon\Carbon;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Generator\StringManipulation\Pass\Pass;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $endDate = now(); // Current date
        $startDate = now()->subMonths(36); // Date 12 months ago
        $properteColumns = [
            'parking_stationnement' => 'Propreté des places de stationnement',
            'parking_espace_v' => 'Propreté des espaces verts',
            'parking_ap_t' => 'Propreté des accès piétons au terminal',
            'hall_public' => 'Propreté du Hall Public',
            'hall_escalier' => 'Propreté des escaliers',
            'hall_escalator' => 'Propreté des escalators',
            'hall_ascenceur' => 'propreté des ascenseurs',
            'hall_facade_v' => 'Propreté des façades vitrées',
            'hall_chariot' => 'Propreté des chariots',
            'hall_siege' => 'Propreté des sièges',
            'toilette_sol' => 'Propreté des sols ',
            'toilette_lavabo_r' => 'Propreté des lavabos, robinetteries',
            'toilette_cuvette' => 'propreté des cuvettes WC',
            'toilette_miroir' => 'Propreté des miroirs',
            'toilette_urinoir' => 'Propreté des urinoirs',
            'toilette_savon_l' => 'Disponibilité du savon liquide',
            'toilette_papier_h' => 'Disponibilité du papier hygiénique',
            'salle_emb_lieux' => 'Propreté des lieux',
            'salle_emb_siege' => 'Propreté des sièges',
            'salle_emb_facade_v' => 'Propreté des façades vitrées',
            'passerelle_sol' => 'Propreté du sol des passerelles	',
            'passerelle_vitre' => 'Propreté des vitres des passerelles	',
            'passerelle_bus' => 'Propreté des bus',
            'bagage_lieux' => 'Propreté des lieux',
            'bagage_tapis' => 'Propreté des tapis à bagages',
            'bagage_chariot' => 'Propreté des chariots à bagages',
            'salle_priere' => 'Propreté des salles de prières',
            'poubelle' => 'Disponibilité des poubelles',
////            // Add more columns as needed
        ];

        $satisfactionDepartColumns = [
            'chariot_disp' => 'Disponibilité des chariots au depart',
            'chariot_qualite' => 'Qualité des chariots au depart',
            'hall_confort' => 'Confort des sièges dans le hall',
            'hall_qualite' => 'Qualité du téléaffichage dans le hall',
            'hall_sonore' => 'Clarté des messages sonores dans le hall',
            'info_orie_agents' => 'Disponibilité des agents orientation',
            'info_orie_qualite' => 'Qualité de accueil et des réponses obtenues',
            'zone_confort_s' => 'Confort des sièges dans l\'embarquement',
            'zone_qualite' => 'Qualité du téléaffichage dans l\'embarquement',
            'zone_sonore' => 'Clarté des messages sonores dans l\'embarquement',
            'confort_hall' => 'Confort climatique Dans le Hall Public',
            'confort_zone' => 'Confort climatique En zone Embarquement',
            'signalisation_parking' => 'Signalisation des parkings',
            'signalisation_chariot' => 'Signalisation des emplacements des chariots',
            'signalisation_hall' => 'Signalisation au niveau du Hall arrivée',
        ];

        $satisfactionArriveColumns = [
            'hall_qlt_aff' => 'Qualité du téléaffichage dans Hall arrivée',
            'bagage_temp_att' => 'Temps d\'attente de récupération bagages',
            'chariot_disp' => 'Disponibilité des chariots à l\'arrivée',
            'chariot_qlt' => 'Qualité des chariots à l\'arrivée',
            'confort_climatique' => 'Confort climatique en zone arrivée',
            'sign_parking' => 'Signalisation des parkings',
            'sign_chariot' => 'Signalisation des emplacements des chariots',
            'sign_hall' => 'Signalisation au niveau du Hall arrivée',
        ];

        $reportProperte = [];

        foreach ($properteColumns as $columnName => $displayName) {
            $result = Surveys::select([
                $columnName,
                DB::raw("COUNT($columnName) as satisfaction"),
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month")
            ])
                ->whereBetween('created_at', [$startDate, $endDate])
                ->groupBy($columnName)
                ->groupBy('month')
                ->orderBy('month', 'asc')
                ->get();

            $result->each(function ($item) use (&$reportProperte, $displayName, $columnName) {
                $reportProperte[$displayName][$item->month][$item->$columnName] = [
                    'count' => $item->satisfaction
                ];
            });
        }

        $reportDepart = [];

        foreach ($satisfactionDepartColumns as $columnName => $displayName) {
            $result = Surveydepart::select([
                $columnName,
                DB::raw("COUNT($columnName) as satisfaction"),
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month")
            ])
                ->whereBetween('created_at', [$startDate, $endDate])
                ->groupBy($columnName)
                ->groupBy('month')
                ->orderBy('month', 'asc')
                ->get();

            $result->each(function ($item) use (&$reportDepart, $displayName, $columnName) {
                $reportDepart[$displayName][$item->month][$item->$columnName] = [
                    'count' => $item->satisfaction
                ];
            });
        }

        $reportArrive = [];

        foreach ($satisfactionArriveColumns as $columnName => $displayName) {
            $result = PassagerArrive::select([
                $columnName,
                DB::raw("COUNT($columnName) as satisfaction"),
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month")
            ])
                ->whereBetween('created_at', [$startDate, $endDate])
                ->groupBy($columnName)
                ->groupBy('month')
                ->orderBy('month', 'asc')
                ->get();

            $result->each(function ($item) use (&$reportArrive, $displayName, $columnName) {
                $reportArrive[$displayName][$item->month][$item->$columnName] = [
                    'count' => $item->satisfaction
                ];
            });
        }

        $report = $reportProperte + $reportArrive + $reportDepart;


//        dd($reportProperte);
//        dd($reportDepart);
//        dd($reportArrive);
//        dd($report);

#for terminal west
        $countThisMounth = [];
        foreach ($properteColumns as $columnName => $displayName) {
            $result = Surveys::select([
                $columnName,
                DB::raw("COUNT($columnName) as satisfaction"),
            ])
                ->where('terminal', '=', 'Terminal Ouest')
                ->where('created_at', '>', Carbon::now()->subMonths(12)->toDateTimeString())
                ->groupBy($columnName)
                ->get();

            $result->each(function ($item) use (&$countThisMounth, $displayName, $columnName) {
                $countThisMounth[$displayName][$item->$columnName] = [
                    'count' => $item->satisfaction
                ];
            });
        }

        $nonSatisfaisantCountWest = 0;
        $moyennementSatisfaisantCountWest = 0;
        $satisfaisantCountWest = 0;

        foreach ($countThisMounth as $displayName => $satisfactionLevels) {
            foreach ($satisfactionLevels as $satisfactionLevel => $satisfactionData) {
                switch ($satisfactionLevel) {
                    case 'Non Satisfaisant':
                        $nonSatisfaisantCountWest += $satisfactionData['count'];
                        break;
                    case 'Moyennement Satisfaisant':
                        $moyennementSatisfaisantCountWest += $satisfactionData['count'];
                        break;
                    case 'Satisfaisant':
                        $satisfaisantCountWest += $satisfactionData['count'];
                        break;
                    // Add more cases for other satisfaction levels as needed
                }
            }
        }

        $terminalWestNumber = [
            $satisfaisantCountWest,
            $moyennementSatisfaisantCountWest,
            $nonSatisfaisantCountWest,
            // Add more counts for other satisfaction levels as needed
        ];

#for terminal one
        $countThisMounth = [];
        foreach ($properteColumns as $columnName => $displayName) {
            $result = Surveys::select([
                $columnName,
                DB::raw("COUNT($columnName) as satisfaction"),
            ])
                ->where('terminal', '=', 'Terminal 1')
                ->where('created_at', '>', Carbon::now()->subMonths(12)->toDateTimeString())
                ->groupBy($columnName)
                ->get();

            $result->each(function ($item) use (&$countThisMounth, $displayName, $columnName) {
                $countThisMounth[$displayName][$item->$columnName] = [
                    'count' => $item->satisfaction
                ];
            });
        }

        $nonSatisfaisantCountOne = 0;
        $moyennementSatisfaisantCountOne = 0;
        $satisfaisantCountOne = 0;

        foreach ($countThisMounth as $displayName => $satisfactionLevels) {
            foreach ($satisfactionLevels as $satisfactionLevel => $satisfactionData) {
                switch ($satisfactionLevel) {
                    case 'Non Satisfaisant':
                        $nonSatisfaisantCountOne += $satisfactionData['count'];
                        break;
                    case 'Moyennement Satisfaisant':
                        $moyennementSatisfaisantCountOne += $satisfactionData['count'];
                        break;
                    case 'Satisfaisant':
                        $satisfaisantCountOne += $satisfactionData['count'];
                        break;
                    // Add more cases for other satisfaction levels as needed
                }
            }
        }

        $terminalOneNumber = [
            $satisfaisantCountOne,
            $moyennementSatisfaisantCountOne,
            $nonSatisfaisantCountOne,
            // Add more counts for other satisfaction levels as needed
        ];

#for terminal west
        $countThisMounth = [];
        foreach ($satisfactionDepartColumns as $columnName => $displayName) {
            $result = Surveydepart::select([
                $columnName,
                DB::raw("COUNT($columnName) as satisfaction"),
            ])
                ->where('terminal', '=', 'Terminal Ouest')
                ->where('created_at', '>', Carbon::now()->subMonths(12)->toDateTimeString())
                ->groupBy($columnName)
                ->get();

            $result->each(function ($item) use (&$countThisMounth, $displayName, $columnName) {
                $countThisMounth[$displayName][$item->$columnName] = [
                    'count' => $item->satisfaction
                ];
            });
        }

        $nonSatisfaisantCountWest = 0;
        $moyennementSatisfaisantCountWest = 0;
        $satisfaisantCountWest = 0;

        foreach ($countThisMounth as $displayName => $satisfactionLevels) {
            foreach ($satisfactionLevels as $satisfactionLevel => $satisfactionData) {
                switch ($satisfactionLevel) {
                    case 'Non Satisfaisant':
                        $nonSatisfaisantCountWest += $satisfactionData['count'];
                        break;
                    case 'Moyennement Satisfaisant':
                        $moyennementSatisfaisantCountWest += $satisfactionData['count'];
                        break;
                    case 'Satisfaisant':
                        $satisfaisantCountWest += $satisfactionData['count'];
                        break;
                    // Add more cases for other satisfaction levels as needed
                }
            }
        }

        $terminalWestSatisfactionDepart = [
            $satisfaisantCountWest,
            $moyennementSatisfaisantCountWest,
            $nonSatisfaisantCountWest,
            // Add more counts for other satisfaction levels as needed
        ];

#for terminal one
        $countThisMounth = [];
        foreach ($satisfactionDepartColumns as $columnName => $displayName) {
            $result = Surveydepart::select([
                $columnName,
                DB::raw("COUNT($columnName) as satisfaction"),
            ])
                ->where('terminal', '=', 'Terminal 1')
                ->where('created_at', '>', Carbon::now()->subMonths(12)->toDateTimeString())
                ->groupBy($columnName)
                ->get();

            $result->each(function ($item) use (&$countThisMounth, $displayName, $columnName) {
                $countThisMounth[$displayName][$item->$columnName] = [
                    'count' => $item->satisfaction
                ];
            });
        }

        $nonSatisfaisantCountOne = 0;
        $moyennementSatisfaisantCountOne = 0;
        $satisfaisantCountOne = 0;

        foreach ($countThisMounth as $displayName => $satisfactionLevels) {
            foreach ($satisfactionLevels as $satisfactionLevel => $satisfactionData) {
                switch ($satisfactionLevel) {
                    case 'Non Satisfaisant':
                        $nonSatisfaisantCountOne += $satisfactionData['count'];
                        break;
                    case 'Moyennement Satisfaisant':
                        $moyennementSatisfaisantCountOne += $satisfactionData['count'];
                        break;
                    case 'Satisfaisant':
                        $satisfaisantCountOne += $satisfactionData['count'];
                        break;
                    // Add more cases for other satisfaction levels as needed
                }
            }
        }

        $terminalOneSatisfactionDepart = [
            $satisfaisantCountOne,
            $moyennementSatisfaisantCountOne,
            $nonSatisfaisantCountOne,
            // Add more counts for other satisfaction levels as needed
        ];


#for terminal west
        $countThisMounth = [];
        foreach ($satisfactionArriveColumns as $columnName => $displayName) {
            $result = PassagerArrive::select([
                $columnName,
                DB::raw("COUNT($columnName) as satisfaction"),
            ])
                ->where('terminal', '=', 'Terminal Ouest')
                ->where('created_at', '>', Carbon::now()->subMonths(12)->toDateTimeString())
                ->groupBy($columnName)
                ->get();

            $result->each(function ($item) use (&$countThisMounth, $displayName, $columnName) {
                $countThisMounth[$displayName][$item->$columnName] = [
                    'count' => $item->satisfaction
                ];
            });
        }

        $nonSatisfaisantCountWest = 0;
        $moyennementSatisfaisantCountWest = 0;
        $satisfaisantCountWest = 0;

        foreach ($countThisMounth as $displayName => $satisfactionLevels) {
            foreach ($satisfactionLevels as $satisfactionLevel => $satisfactionData) {
                switch ($satisfactionLevel) {
                    case 'Non Satisfaisant':
                        $nonSatisfaisantCountWest += $satisfactionData['count'];
                        break;
                    case 'Moyennement Satisfaisant':
                        $moyennementSatisfaisantCountWest += $satisfactionData['count'];
                        break;
                    case 'Satisfaisant':
                        $satisfaisantCountWest += $satisfactionData['count'];
                        break;
                    // Add more cases for other satisfaction levels as needed
                }
            }
        }

        $terminalWestSatisfactionArrive = [
            $satisfaisantCountWest,
            $moyennementSatisfaisantCountWest,
            $nonSatisfaisantCountWest,
            // Add more counts for other satisfaction levels as needed
        ];

#for terminal one
        $countThisMounth = [];
        foreach ($satisfactionArriveColumns as $columnName => $displayName) {
            $result = PassagerArrive::select([
                $columnName,
                DB::raw("COUNT($columnName) as satisfaction"),
            ])
                ->where('terminal', '=', 'Terminal 1')
                ->where('created_at', '>', Carbon::now()->subMonths(12)->toDateTimeString())
                ->groupBy($columnName)
                ->get();

            $result->each(function ($item) use (&$countThisMounth, $displayName, $columnName) {
                $countThisMounth[$displayName][$item->$columnName] = [
                    'count' => $item->satisfaction
                ];
            });
        }

        $nonSatisfaisantCountOne = 0;
        $moyennementSatisfaisantCountOne = 0;
        $satisfaisantCountOne = 0;

        foreach ($countThisMounth as $displayName => $satisfactionLevels) {
            foreach ($satisfactionLevels as $satisfactionLevel => $satisfactionData) {
                switch ($satisfactionLevel) {
                    case 'Non Satisfaisant':
                        $nonSatisfaisantCountOne += $satisfactionData['count'];
                        break;
                    case 'Moyennement Satisfaisant':
                        $moyennementSatisfaisantCountOne += $satisfactionData['count'];
                        break;
                    case 'Satisfaisant':
                        $satisfaisantCountOne += $satisfactionData['count'];
                        break;
                    // Add more cases for other satisfaction levels as needed
                }
            }
        }

        $terminalOneSatisfactionArrive = [
            $satisfaisantCountOne,
            $moyennementSatisfaisantCountOne,
            $nonSatisfaisantCountOne,
            // Add more counts for other satisfaction levels as needed
        ];

        $passagerSatisfactionTerminal1 = array_map(function ($a, $b) {
            return $a + $b;
        }, $terminalOneSatisfactionArrive, $terminalOneSatisfactionDepart);

        $passagerSatisfactionTerminalOuest = array_map(function ($a, $b) {
            return $a + $b;
        }, $terminalWestSatisfactionArrive, $terminalWestSatisfactionDepart);


//        dd($result);
//        dd($terminalOneSatisfactionDepart);
//        dd($terminalOneNumber);

        $monthPercents = [];
        foreach ($countThisMounth as $element => $subArray) {
            $sumFirstSecondCounts = 0;
            $thirdCount = 0;

            foreach ($subArray as $rating => $countArray) {
                $count = $countArray['count'];

                if ($rating == 'Satisfaisant' || $rating == 'Moyennement Satisfaisant') {
                    $sumFirstSecondCounts += $count;
                } elseif ($rating == 'Non Satisfaisant') {
                    $thirdCount = $count;
                }
            }
            $totalSum = $sumFirstSecondCounts + $thirdCount;
            $monthPercents[$element] = number_format($sumFirstSecondCounts * 100 / $totalSum, 2);
        }

        arsort($monthPercents);

// Get the top 4 values from the sorted array
        $topFour = array_slice($monthPercents, 0, 4, true);
// Get the worst 4 values from the sorted array
        $worstFour = array_slice($monthPercents, -4, null, true);
//    dd($monthPercents);
// Combine the arrays if needed
        $combinedArray = array_merge($topFour, $worstFour);
        $criteriaOfPercent = [];
        $percents = [];

        foreach ($combinedArray as $element => $value) {
            $criteriaOfPercent[] = $element;
            $percents[] = $value;
        }

        $countLastMounth = [];
        foreach ($properteColumns as $columnName => $displayName) {
            $result = Surveys::select([
                $columnName,
                DB::raw("COUNT($columnName) as satisfaction"),
            ])
                ->where('status', '=', 'arrivee')
                ->where('terminal', '=', 'Terminal Ouest')
//                ->whereBetween('created_at', [
//                    Carbon::now()->subMonths(2)->startOfMonth(),
//                    Carbon::now()->subMonth(1)->endOfMonth(),
//                ])
                ->whereBetween('created_at', [
                    Carbon::now()->subMonths(2)->startOfMonth(),
                    Carbon::now()->subMonth(1)->endOfMonth(),
                ])
                ->groupBy($columnName)
                ->get();

            $result->each(function ($item) use (&$countLastMounth, $displayName, $columnName) {
                $countLastMounth[$displayName][$item->$columnName] = [
                    'count' => $item->satisfaction
                ];
            });
        }
        $nonSatisfaisantCountLast = 0;
        $moyennementSatisfaisantCountLast = 0;
        $satisfaisantCountLast = 0;

        foreach ($countLastMounth as $displayName => $satisfactionLevels) {
            foreach ($satisfactionLevels as $satisfactionLevel => $satisfactionData) {
                switch ($satisfactionLevel) {
                    case 'Non Satisfaisant':
                        $nonSatisfaisantCountLast += $satisfactionData['count'];
                        break;
                    case 'Moyennement Satisfaisant':
                        $moyennementSatisfaisantCountLast += $satisfactionData['count'];
                        break;
                    case 'Satisfaisant':
                        $satisfaisantCountLast += $satisfactionData['count'];
                        break;
                    // Add more cases for other satisfaction levels as needed
                }
            }
        }
        $lastMonth = [
            $nonSatisfaisantCountLast,
            $moyennementSatisfaisantCountLast,
            $satisfaisantCountLast,
            // Add more counts for other satisfaction levels as needed
        ];

        $satisfactionLists = [
            'Satisfaisant' => [],
            'Moyennement Satisfaisant' => [],
            'Non Satisfaisant' => [],
        ];

        foreach ($properteColumns as $columnName => $displayName) {
            $result = Surveys::select([
                $columnName,
                DB::raw("COUNT($columnName) as satisfaction"),
            ])
                ->where('status', '=', 'arrivee')
                ->where('terminal', '=', 'Terminal Ouest')
                ->where('created_at', '>', Carbon::now()->subMonth(1)->toDateTimeString())
                ->groupBy($columnName)
                ->get();

            foreach ($satisfactionLists as $satisfaction => &$countList) {
                $item = $result->where($columnName, $satisfaction)->first();
                $countList[] = $item ? $item->satisfaction : 0;
            }
        }

// Access the lists outside the loop
        $satisfaisantCounts = $satisfactionLists['Satisfaisant'];
        $moyennementSatisfaisantCounts = $satisfactionLists['Moyennement Satisfaisant'];
        $nonSatisfaisantCounts = $satisfactionLists['Non Satisfaisant'];

//        dd($standardDeviation);

//        dd($thisMonth);
//        dd($satisfaisantCounts, $moyennementSatisfaisantCounts, $nonSatisfaisantCounts);
//        dd($nonSatisfaisantCountThis,$moyennementSatisfaisantCountThis,$satisfaisantCountThis);

//        dd($monthPercents);

        $TerminalOuestcountProperte = Surveys::where('terminal', '=', 'Terminal Ouest')
            ->where('created_at', '>', Carbon::now()->subMonths(12)->toDateTimeString())
            ->count();
        $TerminalOnecountProperte = Surveys::where('terminal', '=', 'Terminal 1')
            ->where('created_at', '>', Carbon::now()->subMonths(12)->toDateTimeString())
            ->count();
        $TerminalOuestArrive = PassagerArrive::where('terminal', '=', 'Terminal Ouest')
            ->where('created_at', '>', Carbon::now()->subMonths(12)->toDateTimeString())
            ->count();
        $TerminalOneArrive = PassagerArrive::where('terminal', '=', 'Terminal 1')
            ->where('created_at', '>', Carbon::now()->subMonths(12)->toDateTimeString())
            ->count();
        $TerminalOuestDepart = Surveydepart::where('terminal', '=', 'Terminal Ouest')
            ->where('created_at', '>', Carbon::now()->subMonths(12)->toDateTimeString())
            ->count();
        $TerminalOneDepart = Surveydepart::where('terminal', '=', 'Terminal 1')
            ->where('created_at', '>', Carbon::now()->subMonths(12)->toDateTimeString())
            ->count();

        $TerminalOuestSatisfaction = $TerminalOuestArrive + $TerminalOuestDepart;
        $TerminalOneSatisfaction = $TerminalOneArrive + $TerminalOneDepart;



//        dd($TerminalOnecountProperte);



        // return view('pages.touest.arivee', ['parking_stationnement'=> $parking_stationnement, 'data'=> $data]);
        return view('pages.homesgsia', compact('report', 'terminalWestNumber', 'terminalOneNumber', 'passagerSatisfactionTerminal1', 'passagerSatisfactionTerminalOuest', 'satisfaisantCounts', 'moyennementSatisfaisantCounts', 'nonSatisfaisantCounts', 'TerminalOuestcountProperte', 'TerminalOnecountProperte', 'TerminalOuestSatisfaction','TerminalOneSatisfaction' ));
    }

}


