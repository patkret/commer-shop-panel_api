<?php

namespace App\Http\Controllers;

use App\AddNewsletter;
use Illuminate\Http\Request;

class AddNewsletterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return AddNewsletterController::all();
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
        AddNewsletter::create($request->all());

        return ['message' => 'ok'];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AddNewsletter  $addNewsletter
     * @return \Illuminate\Http\Response
     */
    public function show(AddNewsletter $addNewsletter)
    {
        $newsletter =
        AddNewsletter::find($addNewsletter);

        return $newsletter;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AddNewsletter  $addNewsletter
     * @return \Illuminate\Http\Response
     */
    public function edit(AddNewsletter $addNewsletter)
    {
        $newsletter =
            AddNewsletter::find($addNewsletter);

        return $newsletter;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AddNewsletter  $addNewsletter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AddNewsletter $addNewsletter)
    {
        $data = $request->all();
        Client::find($addNewsletter)->update($data);
        return ['status' => 1];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AddNewsletter  $addNewsletter
     * @return \Illuminate\Http\Response
     */
    public function destroy(AddNewsletter $addNewsletter)
    {
        AddNewsletter::find($addNewsletter)->delete();
        return ['status' => 1];
    }
}
