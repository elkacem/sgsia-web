<?php

namespace App\Http\Controllers;

use App\Models\Surveys;
use Illuminate\Http\Request;

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
        ,'terminal'             
        ,'parking_stationnement'
        ,'parking_espace_v'     
        ,'parking_ap_t'         
        ,'hall_public'          
        ,'hall_escalier'        
        ,'hall_escalator'       
        ,'hall_ascenceur'       
        ,'hall_facade_v'        
        ,'hall_chariot'         
        ,'hall_siege'           
        ,'toilette_sol'         
        ,'toilette_lavabo_r'    
        ,'toilette_cuvette'     
        ,'toilette_miroir'      
        ,'toilette_urinoir'     
        ,'toilette_savon_l'     
        ,'toilette_papier_h'    
        ,'salle_emb_lieux'      
        ,'salle_emb_siege'      
        ,'salle_emb_facade_v'   
        ,'passerelle_sol'       
        ,'passerelle_vitre'     
        ,'passerelle_bus'       
        ,'bagage_lieux'         
        ,'bagage_tapis'         
        ,'bagage_chariot'       
        ,'salle_priere'         
        ,'poubelle'             )-> get() -> groupBy('terminal');
        return view('dashboard', ['data'=> $data]);
    }

    public function toarrive()
    {
        return view('pages.touest.arivee');
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
