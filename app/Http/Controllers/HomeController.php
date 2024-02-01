<?php

namespace App\Http\Controllers;

use App\Models\Surveys;
use Carbon\Carbon;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $data = Surveys::select('status'
            , 'terminal'
            , 'parking_stationnement'
            , 'parking_espace_v'
            , 'parking_ap_t'
            , 'hall_public'
            , 'hall_escalier'
            , 'hall_escalator'
            , 'hall_ascenceur'
            , 'hall_facade_v'
            , 'hall_chariot'
            , 'hall_siege'
            , 'toilette_sol'
            , 'toilette_lavabo_r'
            , 'toilette_cuvette'
            , 'toilette_miroir'
            , 'toilette_urinoir'
            , 'toilette_savon_l'
            , 'toilette_papier_h'
            , 'salle_emb_lieux'
            , 'salle_emb_siege'
            , 'salle_emb_facade_v'
            , 'passerelle_sol'
            , 'passerelle_vitre'
            , 'passerelle_bus'
            , 'bagage_lieux'
            , 'bagage_tapis'
            , 'bagage_chariot'
            , 'salle_priere'
            , 'poubelle')->get()->groupBy('terminal');
        return view('dashboard', ['data' => $data]);
    }

    public function toarrive()
    {
        $endDate = now(); // Current date
        $startDate = now()->subMonths(12); // Date 12 months ago
        $report = [];

        $columns = [

            'parking_stationnement' => 'Propreté des places de stationnement',
            'parking_espace_v' => 'Propreté des espaces verts',
            'parking_ap_t' => 'Propreté des accès piétons au terminal',
            'hall_public'               => 'Propreté du Hall Public',
            'hall_escalier'             => 'Propreté des escaliers',
            'hall_escalator'            => 'Propreté des escalators',
            'hall_ascenceur'            => 'propreté des ascenseurs',
            'hall_facade_v'             => 'Propreté des façades vitrées',
            'hall_chariot'              => 'Propreté des chariots',
            'hall_siege' => 'Propreté des sièges',
            'toilette_sol'              => 'Propreté des sols ',
            'toilette_lavabo_r'         => 'Propreté des lavabos, robinetteries',
            'toilette_cuvette'          => 'propreté des cuvettes WC',
            'toilette_miroir'           => 'Propreté des miroirs',
            'toilette_urinoir'          => 'Propreté des urinoirs',
            'toilette_savon_l'          => 'Disponibilité du savon liquide',
//            'toilette_papier_h'         => 'Disponibilité du papier hygiénique',
//            'salle_emb_lieux'           => 'Propreté des lieux',
//            'salle_emb_siege'           => 'Propreté des sièges',
//            'salle_emb_facade_v'        => 'Propreté des façades vitrées',
//            'passerelle_sol'            => '',
//            'passerelle_vitre'          => '',
//            'passerelle_bus'            => '',
//            'bagage_lieux'              => 'Propreté des lieux',
//            'bagage_tapis'              => 'Propreté des tapis à bagages',
//            'bagage_chariot'            => 'Propreté des chariots à bagages',
//            'salle_priere'              => 'Propreté des salles de prières',
//            'poubelle'                  => 'Disponibilité des poubelles',
////            // Add more columns as needed
        ];

        foreach ($columns as $columnName => $displayName) {
            $result = Surveys::select([
                $columnName,
                DB::raw("COUNT($columnName) as satisfaction"),
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month")
            ])
                ->where('status', '=', 'arrivee')
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


//        $countValues = Surveys::select(count ( distinct ('parking_stationnement'
//            , 'parking_espace_v'
//            , 'parking_ap_t'
//            , 'hall_public'
//            , 'hall_escalier'
//            , 'hall_escalator'
//            , 'hall_ascenceur'
//            , 'hall_facade_v'
//            , 'hall_chariot'
//            , 'hall_siege'
//            , 'toilette_sol'
//            , 'toilette_lavabo_r'
//            , 'toilette_cuvette'
//            , 'toilette_miroir'
//            , 'toilette_urinoir'
//            , 'toilette_savon_l'
//            , 'toilette_papier_h'
//            , 'salle_emb_lieux'
//            , 'salle_emb_siege'
//            , 'salle_emb_facade_v'
//            , 'passerelle_sol'
//            , 'passerelle_vitre'
//            , 'passerelle_bus'
//            , 'bagage_lieux'
//            , 'bagage_tapis'
//            , 'bagage_chariot'
//            , 'salle_priere'
//            , 'poubelle') ))
//            ->where('status', '=', 'arrivee')
//            ->where('terminal', '=', 'Terminal Ouest')
//            ->where('created_at', '>', Carbon::now()->subMonth(1)->toDateTimeString())
//            ->get();


//        $countValues = Surveys::select('parking_stationnement', \DB::raw('COUNT(*) as count_occurrences'))
//            ->where('status', '=', 'arrivee')
//            ->where('terminal', '=', 'Terminal Ouest')
//            ->whereBetween('created_at', [$startDate, $endDate])
//            ->groupBy('parking_stationnement')
//            ->get();

        $countThisMounth = [];
        foreach ($columns as $columnName => $displayName) {
            $result = Surveys::select([
                $columnName,
                DB::raw("COUNT($columnName) as satisfaction"),
            ])
                ->where('status', '=', 'arrivee')
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

        $countLastMounth = [];
        foreach ($columns as $columnName => $displayName) {
            $result = Surveys::select([
                $columnName,
                DB::raw("COUNT($columnName) as satisfaction"),
            ])
                ->where('status', '=', 'arrivee')
                ->where('terminal', '=', 'Terminal Ouest')
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
            $result = Surveys::select([
                $columnName,
                DB::raw("COUNT($columnName) as satisfaction"),
            ])
                ->where('status', '=', 'arrivee')
                ->where('terminal', '=', 'Terminal Ouest')
                ->whereBetween('created_at', [
                    Carbon::now()->subMonths(2)->startOfMonth(),
                    Carbon::now()->subMonth(1)->endOfMonth(),
                ])
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

//        dd($thisMonth);
//        dd($satisfaisantCounts, $moyennementSatisfaisantCounts, $nonSatisfaisantCounts);
//        dd($nonSatisfaisantCountThis,$moyennementSatisfaisantCountThis,$satisfaisantCountThis);

//        dd($criterias);

        // return view('pages.touest.arivee', ['parking_stationnement'=> $parking_stationnement, 'data'=> $data]);
        return view('pages.touest.arivee', compact('report', 'criterias', 'thisMonth', 'lastMonth','satisfaisantCounts','moyennementSatisfaisantCounts','nonSatisfaisantCounts'));
    }

    public function todepart()
    {
        return view('pages.touest.depart');
    }

    public function tonearrive()
    {
        return view('pages.tone.arivee');
    }

    public function tonedepart()
    {
        return view('pages.tone.depart');
    }

}


