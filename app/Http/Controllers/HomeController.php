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

            'parking_stationnement'     => 'Propreté des places de stationnement',
            'parking_espace_v'          => 'Propreté des espaces verts',
            'parking_ap_t'              => 'Propreté des accès piétons au terminal',
            'hall_public'               => 'Propreté du Hall Public',
            'hall_escalier'             => 'Propreté des escaliers',
            'hall_escalator'            => 'Propreté des escalators',
            'hall_ascenceur'            => 'propreté des ascenseurs',
            'hall_facade_v'             => 'Propreté des façades vitrées',
            'hall_chariot'              => 'Propreté des chariots',
            'hall_siege'                => 'Propreté des sièges',
            'toilette_sol'              => 'Propreté des sols ',
            'toilette_lavabo_r'         => 'Propreté des lavabos, robinetteries',
            'toilette_cuvette'          => 'propreté des cuvettes WC',
            'toilette_miroir'           => 'Propreté des miroirs',
            'toilette_urinoir'          => 'Propreté des urinoirs',
            'toilette_savon_l'          => 'Disponibilité du savon liquide',
            'toilette_papier_h'         => 'Disponibilité du papier hygiénique',
            'salle_emb_lieux'           => 'Propreté des lieux',
            'salle_emb_siege'           => 'Propreté des sièges',
            'salle_emb_facade_v'        => 'Propreté des façades vitrées',
//            'passerelle_sol'            => '',
//            'passerelle_vitre'          => '',
//            'passerelle_bus'            => '',
            'bagage_lieux'              => 'Propreté des lieux',
            'bagage_tapis'              => 'Propreté des tapis à bagages',
            'bagage_chariot'            => 'Propreté des chariots à bagages',
            'salle_priere'              => 'Propreté des salles de prières',
            'poubelle'                  => 'Disponibilité des poubelles',
//            // Add more columns as needed
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
                ->orderBy('month')
                ->get();

            $result->each(function ($item) use (&$report, $displayName, $columnName) {
                $report[$displayName][$item->month][$item->$columnName] = [
                    'count' => $item->satisfaction
                ];
            });
        }
//
//
//        $parking_stationnement = Surveys::select([
//            'parking_stationnement',
//            DB::raw('COUNT(parking_stationnement) as satisfaction'),
//            DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month")])
//            ->where('status', '=', 'arrivee')
//            ->where('terminal', '=', 'Terminal Ouest')
//            ->whereBetween('created_at', [$startDate, $endDate]) // Filter by the last 12 months
//            ->groupBy('parking_stationnement')
//            ->groupBy('month')
//            ->get();
//
//        $parking_stationnement->each(function ($item) use (&$report) {
//            $report['Propreté des places de stationnement'][$item->month][$item->parking_stationnement] = [
//                'count' => $item->satisfaction
//            ];
//        });
//
//        $parking_espace_v = Surveys::select([
//            'parking_espace_v',
//            DB::raw('COUNT(parking_espace_v) as satisfaction'),
//            DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month")])
//            ->where('status', '=', 'arrivee')
//            ->where('terminal', '=', 'Terminal Ouest')
//            ->whereBetween('created_at', [$startDate, $endDate]) // Filter by the last 12 months
//            ->groupBy('parking_espace_v')
//            ->groupBy('month')
//            ->get();
//
//        $parking_espace_v->each(function ($item) use (&$report) {
//            $report['okey'][$item->month][$item->parking_espace_v] = [
//                'count' => $item->satisfaction
//            ];
//        });
//

//        $endDate = now(); // Current date
//        $startDate = now()->subMonths(12); // Date 12 months ago
//
//        $selectedColumns = [
//            'parking_stationnement',
//            'hall_public',
//            'hall_escalier',
//            // Add other columns here
//        ];
//
//        $selectExpressions = array_map(function ($column) {
//            return DB::raw("COUNT($column) as $column");
//        }, $selectedColumns);
//
//        $selectExpressions = array_map(function ($column) {
//            return DB::raw("COUNT($column) as {$column}_count");
//        }, $selectedColumns);
//
//        $query = Surveys::select([...$selectedColumns, ...$selectExpressions, DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month")])
//            ->where('status', '=', 'arrivee')
//            ->where('terminal', '=', 'Terminal Ouest')
//            ->whereBetween('created_at', [$startDate, $endDate]) // Filter by the last 12 months
//            ->groupBy([...$selectedColumns, DB::raw("DATE_FORMAT(created_at, '%Y-%m')")])
//            ->get();
//
//
//        $query->each(function ($item) use (&$report, $selectedColumns) {
//            $key = array_reduce($selectedColumns, function ($carry, $column) use ($item) {
//                $carry[$column] = $item->$column;
//                return $carry;
//            }, []);
//
//            $keyString = json_encode($key);
//
//            $counts = array_map(function ($column) use ($item) {
//                return $item->{$column} ?? 0;
//            }, $selectedColumns);
//
//            $report[$item->month][$keyString] = [
//                'counts' => $counts
//            ];
//        });


        $parking_stationnement = Surveys::select('parking_stationnement', DB::raw('COUNT(parking_stationnement) as count'))
            ->where('status', '=', 'arrivee')
            ->where('terminal', '=', 'Terminal Ouest')
            ->where('created_at', '>', Carbon::now()->subMonth(4)->toDateTimeString())
            ->groupBy('parking_stationnement')
            ->get();

        $data = Surveys::select(
            'parking_stationnement'
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
            , 'poubelle')
            ->where('status', '=', 'arrivee')->where('terminal', '=', 'Terminal Ouest')
            // ->where('created_at', '<', Carbon::now()->subMinutes(5)->toDateTimeString())
            ->get();

        // -> groupBy('terminal');

//        dd($report);
//        dd(len$report);

        // return view('pages.touest.arivee', ['parking_stationnement'=> $parking_stationnement, 'data'=> $data]);
        return view('pages.touest.arivee', compact('report'));
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
