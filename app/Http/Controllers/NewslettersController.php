<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsletterRequest;
use App\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewslettersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Newsletter::all();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsletterRequest $request)
    {
//        $validator = Validator::make($request->all(), [
//            'email' => 'required|email'
//        ]);
//
//        if ($validator->fails()) {
//            return response()->json(['error'=> $validator->errors()]);
//        }

        Newsletter::create($request->all());

        return ['message' => 'ok'];

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
        $data = $request->all();
        //Newsletter::find($id)->update($data);

        $notification = Newsletter::find($id);
        $notification->status = $data['active'];

        $notification->save();
        return ['status' => 1];

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Newsletter::find($id)->delete();

        return ['status' => 1];

    }
}
