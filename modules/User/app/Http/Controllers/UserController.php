<?php

namespace Modules\User\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\User\App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user::index');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        try{
            $users = User::all();

            return response() -> json($users);
        }
        catch(\Exception $error){
            return response() -> json(['error', 'Could not find any user'], 404);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $password = Hash::make($request -> password, ['round' => 10]);

            $user = new User();
            $user -> first_name = $request -> first_name;
            $user -> last_name = $request -> last_name;
            $user -> email = $request -> email;
            $user -> password = $password;

            $user -> save();

            return response() -> json(['message' => 'User account creation was successful'], 201);
        }
        catch(\Exception $error){
            return response()->json(['error' => $error -> getMessage()], 500);
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('user::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage completely
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user -> forceDetele();
    }

    /**
     * Move a record to trash
     */

    public function trash($id)
    {
        try{
            $user = User::find($id);
            $user -> delete();

            return response() -> json(['message' => "User has been deleted permanently"], 200);
        }
        catch(\Exception $e){
            return response() -> json(['error' => "User not found"], 404);
        }
    }

    public function restore($id)
    {
        try{
            $user = User::find($id);
            $user -> restore($id);
            return response() -> json(['message' => "User has been moved to trash"], 200);
        }
        catch(\Exception $e){
            return response()->json(['error' => 'User not found'], 404);
        }
    }

    public function delete_from_trash($id)
    {
        try{
            $user = User::find($id);
            $user -> forceDelete();
        }
        catch(\Exception $e){
            return response()->json(['error' => 'User not found'], 404);
        }
    }

}
