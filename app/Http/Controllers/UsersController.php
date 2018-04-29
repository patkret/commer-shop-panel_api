<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use app\Exceptions\Handler;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index()
    {
        $users = User::all();

        return $users->makeVisible('password')->toArray();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function store(Request $request)
    {
        User::create($request->all());

        return ['status' => 1];
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        User::find($id)->update($request->editedUser);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();


    }

    public function duplicate(Request $request)
    {
       User::create($request->duplicatingUser);

    }

    public function changePassword(Request $request, $id){


        $oldPassword = bcrypt($request->get('user')['oldPassword']);
//        $oldPassword = $request->user['oldPassword'];
        $user = User::where('id', $id)->first();


        if(Hash::check($request->get('user')['oldPassword'], $user->password)){

            $user->update(['password' => $request->user['newPassword']]);
        }
        else{
            abort(500);
        }
    }

    public function getUser($id){

        return User::where('id', $id)->first();
    }

}
