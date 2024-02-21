<?php

namespace App\Http\Controllers;

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
        $getRecord = Surveys::select('id','suggestion', 'status', 'terminal', 'user_id')
            ->whereNotNull('suggestion')
            ->groupBy('id','suggestion', 'status', 'terminal', 'user_id')
            ->orderBy('created_at', 'asc')
            ->get();
        $data['getRecord'] = $getRecord;
        return view('pages.comments.list', $data);
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
}
