<?php

namespace App\Http\Controllers;

use App\UserModuleAccess;
use Illuminate\Http\Request;

class UserModuleAccessesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $permissions = $request->permissions;
        $test = UserModuleAccess::where('user_id', 2)->get()->toArray();
//        dd($test);
        foreach($permissions as $item){
            $temp = explode('|', $item);
            $user_access = ['user_id' => $request->user_id, 'module_id' => $temp[0], 'access_rights' => $temp[1]];
            UserModuleAccess::updateOrCreate($user_access);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
