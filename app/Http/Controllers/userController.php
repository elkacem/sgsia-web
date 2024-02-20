<?php

namespace App\Http\Controllers;

use App\Models\PassagerArrive;
use App\Models\Surveydepart;
use App\Models\Surveys;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        $usersWithCounts = User::withCount(['Surveys', 'Surveydepart', 'PassagerArrive'])->get();
          $getRecord = User::withCount(['Surveys', 'Surveydepart', 'PassagerArrive'])
            ->where('is_deleted', '=', 0)
            ->orderBy('created_at', 'desc')
            ->get();

//        dd($usersWithCounts);
        $data['header_title'] = "Admin Space";
//        $data['getRecord'] = User::getUser();
        $data['getRecord'] = $getRecord;
//        dd($data);
        return view('users.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['header_title'] = "Admin Add";
        return view('users.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|string|unique:users,username',
            'password' => 'required|min:8',
            'is_admin' => 'required|boolean',
        ]);
        $user = new User;
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        $user->username = trim($request->username);
        $user->password = Hash::make($request->password);
        $user->is_admin = trim($request->is_admin);
        $user->save();


        return redirect()->route('list')->with('success', 'Utilisateur ajouté avec succès');
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
    public function edit($id)
    {
        $data['getRecord'] = User::getSingle($id);
        if(!empty($data['getRecord'])){
            $data['header_title'] = "Admin Edit";
            return view('users.edit', $data);
        }
        else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,'. $id,
            'username' => 'required|string|unique:users,username,'. $id,
            'is_admin' => 'required|boolean',
        ]);
        $user = User::getSingle($id);
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        $user->username = trim($request->username);
        if(!empty($request->password)){
            $user->password = Hash::make($request->password);
        }
        $user->is_admin = trim($request->is_admin);
        $user->save();

        return redirect()->route('list')->with('success', 'Utilisateur a été mis à jour avec succès');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::getSingle($id);
//        dd($user);
        if($user->is_admin == 0 ){
            $user->is_deleted = 1;
            $user->save();
        }

        return redirect()->route('list')->with('success', 'Utilisateur supprimé avec succès');
    }


    public function editSingle($id)
    {
        $data['getRecord'] = User::getSingle($id);
        if(!empty($data['getRecord'])){
            $data['header_title'] = "Admin Edit";
            return view('users.editSingle', $data);
        }
        else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateSingle(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,'. $id,
            'username' => 'required|string|unique:users,username,'. $id,
        ]);
        $user = User::getSingle($id);
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        $user->username = trim($request->username);
        if(!empty($request->password)){
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->route('home')->with('success', 'Utilisateur a été mis à jour avec succès');

    }

}
