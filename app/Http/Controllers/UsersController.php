<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

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

        return $users;
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
    public function show($id)
    {
        //
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

        User::find($id)->update($request->user);

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

    public function getShopModules()
    {

        $modules = [
            [
                'id' => 0,
                'name' => 'Sprzedaż'
            ],
            [
                'id' => 1,
                'name' => 'Asortyment'
            ],
            [
                'id' => 2,
                'name' => 'Klienci'
            ],
            [
                'id' => 3,
                'name' => 'Marketing'
            ],
            [
                'id' => 4,
                'name' => 'Raporty'
            ],
            [
                'id' => 5,
                'name' => 'Ustawienia'
            ],
            [
                'id' => 6,
                'name' => 'Integracje'
            ],
        ];

        return $modules;
    }

    public function getAccessRights()
    {

        $modules = [
            [
                'id' => 0,
                'name' => 'odczyt'
            ],
            [
                'id' => 1,
                'name' => 'dodawanie'
            ],
            [
                'id' => 2,
                'name' => 'edycja'
            ],
            [
                'id' => 3,
                'name' => 'usuwanie'
            ],
        ];

        return $modules;
    }
}
