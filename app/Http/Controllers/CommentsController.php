<?php

namespace App\Http\Controllers;

use App\Models\PassagerArrive;
use App\Models\Surveydepart;
use App\Models\Surveys;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        $getRecord = Surveys::select('id','suggestion', 'status', 'terminal', 'user_id')
//            ->whereNotNull('suggestion')
//            ->groupBy('id','suggestion', 'status', 'terminal', 'user_id')
//            ->orderBy('created_at', 'asc')
//            ->get();
        $getRecord = Surveys::select('surveys.id','surveys.suggestion', 'surveys.status', 'surveys.terminal', 'surveys.user_id', 'users.name')
            ->leftJoin('users', 'surveys.user_id', '=', 'users.id')
            ->whereNotNull('surveys.suggestion')
            ->groupBy('surveys.id','surveys.suggestion', 'surveys.status', 'surveys.terminal', 'surveys.user_id', 'users.name')
            ->orderBy('surveys.created_at', 'asc')
            ->get();
        $data['getRecord'] = $getRecord;
        return view('pages.comments.list', $data);
    }

    public function indexSatisfaction()
    {
//        $getRecordDepart = Surveydepart::select('id', 'suggestion', 'terminal', 'user_id', 'status')
//            ->whereNotNull('suggestion')
//            ->groupBy('id', 'suggestion', 'terminal', 'user_id', 'status')
//            ->orderBy('created_at', 'asc')
//            ->get();
        $getRecordDepart = Surveydepart::select('surveydeparts.id','surveydeparts.suggestion', 'surveydeparts.status', 'surveydeparts.terminal', 'surveydeparts.user_id', 'users.name')
            ->leftJoin('users', 'surveydeparts.user_id', '=', 'users.id')
            ->whereNotNull('surveydeparts.suggestion')
            ->groupBy('surveydeparts.id','surveydeparts.suggestion', 'surveydeparts.status', 'surveydeparts.terminal', 'surveydeparts.user_id', 'users.name')
            ->orderBy('surveydeparts.created_at', 'asc')
            ->get();

//        $getRecordArrive = PassagerArrive::select('id', 'suggestion', 'terminal', 'user_id', 'status')
//            ->whereNotNull('suggestion')
//            ->groupBy('id', 'suggestion', 'terminal', 'user_id', 'status')
//            ->orderBy('created_at', 'asc')
//            ->get();

        $getRecordArrive = PassagerArrive::select('passager_arrives.id','passager_arrives.suggestion', 'passager_arrives.status', 'passager_arrives.terminal', 'passager_arrives.user_id', 'users.name')
            ->leftJoin('users', 'passager_arrives.user_id', '=', 'users.id')
            ->whereNotNull('passager_arrives.suggestion')
            ->groupBy('passager_arrives.id','passager_arrives.suggestion', 'passager_arrives.status', 'passager_arrives.terminal', 'passager_arrives.user_id', 'users.name')
            ->orderBy('passager_arrives.created_at', 'asc')
            ->get();


        $data['getRecordDepart'] = $getRecordDepart;
        $data['getRecordArrive'] = $getRecordArrive;
        return view('pages.comments.listSatisfaction', $data);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = Surveys::getSingle($id);
        if (!$user) {
            return redirect()->route('listComments')->with('error', 'Commentaire introuvable');
        }

        $user->update(['suggestion' => null]); // Replace 'column_to_delete' with the actual column name

        return redirect()->route('listComments')->with('success', 'Commentaire supprimé avec succès');
//        $user = Surveys::getSingle($id);
////        dd($user);
//        if($user->is_admin == 0 ){
//            $user->is_deleted = 1;
//            $user->save();
//        }

//        return redirect()->route('list')->with('success', 'Utilisateur supprimé avec succès');
    }

    public function destroySatisfaction(Request $request, $status, $id)
    {
        if ($status == 0){
//            dd($status);
            $user = Surveydepart::getSingle($id);
            $user->update(['suggestion' => null]); // Replace 'column_to_delete' with the actual column name
          return redirect()->route('listCommentssatisfaction')->with('success', 'Commentaire supprimé avec succès');
        }
        else{
            $user = PassagerArrive::getSingle($id);
            $user->update(['suggestion' => null]); // Replace 'column_to_delete' with the actual column name
            return redirect()->route('listCommentssatisfaction')->with('success', 'Commentaire supprimé avec succès');
            }

    }
}
