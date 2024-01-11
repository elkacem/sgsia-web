<?php

use App\Models\Surveys;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/surveys', function(Request $request) {
    $request -> validate([
        'status'                => 'required',
        'terminal'              => 'required',
        'parking_stationnement' => 'required',
        'parking_espace_v'      => 'required',
        'parking_ap_t'          => 'required',
        'hall_public'           => 'required',
        'hall_escalier'         => 'required',
        'hall_escalator'        => 'required',
        'hall_ascenceur'        => 'required',
        'hall_facade_v'         => 'required',
        'hall_chariot'          => 'required',
        'hall_siege'            => 'required',
        'toilette_sol'          => 'required',
        'toilette_lavabo_r'     => 'required',
        'toilette_cuvette'      => 'required',
        'toilette_miroir'       => 'required',
        'toilette_urinoir'      => 'required',
        'toilette_savon_l'      => 'required',
        'toilette_papier_h'     => 'required',

        'salle_emb_lieux'       => 'required_if:status,depart',
        'salle_emb_siege'       => 'required_if:status,depart',
        'salle_emb_facade_v'    => 'required_if:status,depart',
        'passerelle_sol'        => 'required_if:status,arrivee',
        'passerelle_vitre'      => 'required_if:status,arrivee',
        'passerelle_bus'        => 'required_if:status,arrivee',

        'bagage_lieux'          => 'required',
        'bagage_tapis'          => 'required',
        'bagage_chariot'        => 'required',
        'salle_priere'          => 'required',
        'poubelle'              => 'required',
        
        'suggestion' => 'required'
    ]);

    return Surveys::create([
        'user_id' => 1,
        
        'status'                => $request->status                 ,
        'terminal'              => $request->terminal               ,
        'parking_stationnement' => $request->parking_stationnement  ,
        'parking_espace_v'      => $request->parking_espace_v       ,
        'parking_ap_t'          => $request->parking_ap_t           ,
        'hall_public'           => $request->hall_public            ,
        'hall_escalier'         => $request->hall_escalier          ,
        'hall_escalator'        => $request->hall_escalator         ,
        'hall_ascenceur'        => $request->hall_ascenceur         ,
        'hall_facade_v'         => $request->hall_facade_v          ,
        'hall_chariot'          => $request->hall_chariot           ,
        'hall_siege'            => $request->hall_siege             ,
        'toilette_sol'          => $request->toilette_sol           ,
        'toilette_lavabo_r'     => $request->toilette_lavabo_r      ,
        'toilette_cuvette'      => $request->toilette_cuvette       ,
        'toilette_miroir'       => $request->toilette_miroir        ,
        'toilette_urinoir'      => $request->toilette_urinoir       ,
        'toilette_savon_l'      => $request->toilette_savon_l       ,
        'toilette_papier_h'     => $request->toilette_papier_h      ,
        'salle_emb_lieux'       => $request->salle_emb_lieux        ,
        'salle_emb_siege'       => $request->salle_emb_siege        ,
        'salle_emb_facade_v'    => $request->salle_emb_facade_v     ,
        'passerelle_sol'        => $request->passerelle_sol         ,
        'passerelle_vitre'      => $request->passerelle_vitre       ,
        'passerelle_bus'        => $request->passerelle_bus         ,
        'bagage_lieux'          => $request->bagage_lieux           ,
        'bagage_tapis'          => $request->bagage_tapis           ,
        'bagage_chariot'        => $request->bagage_chariot         ,
        'salle_priere'          => $request->salle_priere           ,
        'poubelle'              => $request->poubelle               ,
        
        'suggestion' => $request->suggestion,
    ]);
});


Route::post('/login', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'device_name' => 'required',
    ]);
 
    $user = User::where('email', $request->email)->first();
 
    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }
 
    $token = $user->createToken($request->device_name)->plainTextToken;
    return response()->json([
        'token' => $token,
        'user' => $user->only('id', 'name', 'username', 'email'),
    ], 201);
});


Route::middleware('auth:sanctum')->post('/logout', function (Request $request) {
    $request->user()->currentAccessToken()->delete();
    return response()->json('Logged out', 200);
});

Route::post('/register', function (Request $request) {
    $request->validate([
        'name' => 'required'
        'email' => 'required|email|unique:users',
        'username' => 'required|min:4|unique:users',
        'password' => 'required|min:6|confirmed',
        'device_name' => 'required',
    ]);

    
    $user = User::create([
        'name' => $request
    ])
 
    
});
