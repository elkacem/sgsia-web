<?php

namespace App\Http\Controllers;

use App\Models\PassagerArrive;
use App\Models\Surveydepart;
use App\Http\Requests\StoreSurveydepartRequest;
use App\Http\Requests\UpdateSurveydepartRequest;
use App\Models\Surveys;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SurveydepartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $endDate = now(); // Current date
        $startDate = now()->subMonth(1); // Date 12 months ago
        $report = [];
        $columns = [
            'chariot_disp' => 'Disponibilité des chariots',
            'chariot_qualite' => 'Qualité des chariots',
            'hall_confort' => 'Confort des sièges',
            'hall_qualite' => 'Qualité du téléaffichage',
            'hall_sonore' => 'Clarté des messages sonores',
            'info_orie_agents' => 'Disponibilité des agents orientation',
            'info_orie_qualite' => 'Qualité de accueil et des réponses obtenues',
            'zone_confort_s' => 'Confort des sièges',
            'zone_qualite' => 'Qualité du téléaffichage',
            'zone_sonore' => 'Clarté des messages sonores',
            'confort_hall' => 'Dans le Hall Public',
            'confort_zone' => 'En zone Embarquement',
            'signalisation_parking' => 'Signalisation des parkings',
            'signalisation_chariot' => 'Signalisation des emplacements des chariots',
            'signalisation_hall' => 'Signalisation au niveau du Hall arrivée',
        ];

        foreach ($columns as $columnName => $displayName) {
            $result = Surveydepart::select([
                $columnName,
                DB::raw("COUNT($columnName) as satisfaction"),
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month")
            ])
                ->where('terminal', '=', 'Terminal Ouest')
                ->whereBetween('created_at', [$startDate, $endDate])
                ->groupBy($columnName)
                ->groupBy('month')
                ->orderBy('month', 'asc')
                ->get();

            $result->each(function ($item) use (&$report, $displayName, $columnName) {
                $report[$displayName][$item->month][$item->$columnName] = [
                    'count' => $item->satisfaction
                ];
            });
        }
        $criterias = [];
        foreach ($report as $criteria => $values) {
            $criterias[] = $criteria;
        }
        $countThisMounth = [];
        foreach ($columns as $columnName => $displayName) {
            $result = Surveydepart::select([
                $columnName,
                DB::raw("COUNT($columnName) as satisfaction"),
            ])
                ->where('terminal', '=', 'Terminal Ouest')
                ->where('created_at', '>', Carbon::now()->subMonth(1)->toDateTimeString())
                ->groupBy($columnName)
                ->get();

            $result->each(function ($item) use (&$countThisMounth, $displayName, $columnName) {
                $countThisMounth[$displayName][$item->$columnName] = [
                    'count' => $item->satisfaction
                ];
            });
        }

        $nonSatisfaisantCountThis = 0;
        $moyennementSatisfaisantCountThis = 0;
        $satisfaisantCountThis = 0;

        foreach ($countThisMounth as $displayName => $satisfactionLevels) {
            foreach ($satisfactionLevels as $satisfactionLevel => $satisfactionData) {
                switch ($satisfactionLevel) {
                    case 'Non Satisfaisant':
                        $nonSatisfaisantCountThis += $satisfactionData['count'];
                        break;
                    case 'Moyennement Satisfaisant':
                        $moyennementSatisfaisantCountThis += $satisfactionData['count'];
                        break;
                    case 'Satisfaisant':
                        $satisfaisantCountThis += $satisfactionData['count'];
                        break;
                    // Add more cases for other satisfaction levels as needed
                }
            }
        }

        $thisMonth = [
            $nonSatisfaisantCountThis,
            $moyennementSatisfaisantCountThis,
            $satisfaisantCountThis,
            // Add more counts for other satisfaction levels as needed
        ];

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
        foreach ($columns as $columnName => $displayName) {
            $result = Surveydepart::select([
                $columnName,
                DB::raw("COUNT($columnName) as satisfaction"),
            ])
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

        foreach ($columns as $columnName => $displayName) {
            $result = Surveydepart::select([
                $columnName,
                DB::raw("COUNT($columnName) as satisfaction"),
            ])
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

//        dd($monthPercents);
        // Calculate standard deviation using ecart_type function
        $standardDeviation = $this->ecart_type($monthPercents);


//        dd($standardDeviation);

//        dd($thisMonth);
//        dd($satisfaisantCounts, $moyennementSatisfaisantCounts, $nonSatisfaisantCounts);
//        dd($nonSatisfaisantCountThis,$moyennementSatisfaisantCountThis,$satisfaisantCountThis);

//        dd($monthPercents);

//        dd($monthPercents);

        // return view('pages.touest.arivee', ['parking_stationnement'=> $parking_stationnement, 'data'=> $data]);
        return view('pages.touest.passenger.arivee', compact('report', 'criterias', 'thisMonth', 'lastMonth', 'satisfaisantCounts', 'moyennementSatisfaisantCounts', 'nonSatisfaisantCounts', 'monthPercents', 'criteriaOfPercent', 'percents', 'standardDeviation'));
    }

    public function indexo()
    {
        $endDate = now(); // Current date
        $startDate = now()->subMonth(1); // Date 12 months ago
        $report = [];
        $columns = [
            'chariot_disp' => 'Disponibilité des chariots',
            'chariot_qualite' => 'Qualité des chariots',
            'hall_confort' => 'Confort des sièges',
            'hall_qualite' => 'Qualité du téléaffichage',
            'hall_sonore' => 'Clarté des messages sonores',
            'info_orie_agents' => 'Disponibilité des agents orientation',
            'info_orie_qualite' => 'Qualité de accueil et des réponses obtenues',
            'zone_confort_s' => 'Confort des sièges',
            'zone_qualite' => 'Qualité du téléaffichage',
            'zone_sonore' => 'Clarté des messages sonores',
            'confort_hall' => 'Dans le Hall Public',
            'confort_zone' => 'En zone Embarquement',
            'signalisation_parking' => 'Signalisation des parkings',
            'signalisation_chariot' => 'Signalisation des emplacements des chariots',
            'signalisation_hall' => 'Signalisation au niveau du Hall arrivée',
        ];

        foreach ($columns as $columnName => $displayName) {
            $result = Surveydepart::select([
                $columnName,
                DB::raw("COUNT($columnName) as satisfaction"),
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month")
            ])
                ->where('terminal', '=', 'Terminal 1')
                ->whereBetween('created_at', [$startDate, $endDate])
                ->groupBy($columnName)
                ->groupBy('month')
                ->orderBy('month', 'asc')
                ->get();

            $result->each(function ($item) use (&$report, $displayName, $columnName) {
                $report[$displayName][$item->month][$item->$columnName] = [
                    'count' => $item->satisfaction
                ];
            });
        }
        $criterias = [];
        foreach ($report as $criteria => $values) {
            $criterias[] = $criteria;
        }
        $countThisMounth = [];
        foreach ($columns as $columnName => $displayName) {
            $result = Surveydepart::select([
                $columnName,
                DB::raw("COUNT($columnName) as satisfaction"),
            ])
                ->where('terminal', '=', 'Terminal 1')
                ->where('created_at', '>', Carbon::now()->subMonth(1)->toDateTimeString())
                ->groupBy($columnName)
                ->get();

            $result->each(function ($item) use (&$countThisMounth, $displayName, $columnName) {
                $countThisMounth[$displayName][$item->$columnName] = [
                    'count' => $item->satisfaction
                ];
            });
        }

        $nonSatisfaisantCountThis = 0;
        $moyennementSatisfaisantCountThis = 0;
        $satisfaisantCountThis = 0;

        foreach ($countThisMounth as $displayName => $satisfactionLevels) {
            foreach ($satisfactionLevels as $satisfactionLevel => $satisfactionData) {
                switch ($satisfactionLevel) {
                    case 'Non Satisfaisant':
                        $nonSatisfaisantCountThis += $satisfactionData['count'];
                        break;
                    case 'Moyennement Satisfaisant':
                        $moyennementSatisfaisantCountThis += $satisfactionData['count'];
                        break;
                    case 'Satisfaisant':
                        $satisfaisantCountThis += $satisfactionData['count'];
                        break;
                    // Add more cases for other satisfaction levels as needed
                }
            }
        }

        $thisMonth = [
            $nonSatisfaisantCountThis,
            $moyennementSatisfaisantCountThis,
            $satisfaisantCountThis,
            // Add more counts for other satisfaction levels as needed
        ];

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
        foreach ($columns as $columnName => $displayName) {
            $result = Surveydepart::select([
                $columnName,
                DB::raw("COUNT($columnName) as satisfaction"),
            ])
                ->where('terminal', '=', 'Terminal 1')
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

        foreach ($columns as $columnName => $displayName) {
            $result = Surveydepart::select([
                $columnName,
                DB::raw("COUNT($columnName) as satisfaction"),
            ])
                ->where('terminal', '=', 'Terminal 1')
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

//        dd($monthPercents);
        // Calculate standard deviation using ecart_type function
        $standardDeviation = $this->ecart_type($monthPercents);


//        dd($standardDeviation);

//        dd($thisMonth);
//        dd($satisfaisantCounts, $moyennementSatisfaisantCounts, $nonSatisfaisantCounts);
//        dd($nonSatisfaisantCountThis,$moyennementSatisfaisantCountThis,$satisfaisantCountThis);

//        dd($monthPercents);

//        dd($monthPercents);

        // return view('pages.touest.arivee', ['parking_stationnement'=> $parking_stationnement, 'data'=> $data]);
        return view('pages.touest.passenger.depart', compact('report', 'criterias', 'thisMonth', 'lastMonth', 'satisfaisantCounts', 'moyennementSatisfaisantCounts', 'nonSatisfaisantCounts', 'monthPercents', 'criteriaOfPercent', 'percents', 'standardDeviation'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSurveydepartRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Surveydepart $surveydepart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Surveydepart $surveydepart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSurveydepartRequest $request, Surveydepart $surveydepart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Surveydepart $surveydepart)
    {
        //
    }

    private function ecart_type($donnees)
    {
        // 0 - Nombre d’éléments dans le tableau
        $population = count($donnees);

        if ($population != 0) {
            // 1 - somme du tableau
            $somme_tableau = array_sum($donnees);

            // 2 - Calcul de la moyenne
            $moyenne = $somme_tableau / $population;

            // 3 - écart pour chaque valeur
            $ecart = [];

            foreach ($donnees as $rating) {
                // écart entre la valeur et la moyenne
                $ecart_donnee = floatval($rating) - $moyenne;

                // carré de l'écart
                $ecart_donnee_carre = $ecart_donnee ** 2;

                // Insertion dans le tableau
                array_push($ecart, $ecart_donnee_carre);
            }

            // 4 - somme des écarts
            $somme_ecart = array_sum($ecart);

            // 5 - division de la somme des écarts par la population
            $division = $somme_ecart / $population;

            // 6 - racine carrée de la division
            $ecart_type = sqrt($division);
        } else {
            $ecart_type = 0;
        }

        // 7 - renvoi du résultat
        return number_format($ecart_type, 2);
    }
}
