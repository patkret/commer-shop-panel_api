<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EmailRequest;
use App\Email;
class EmailsController extends Controller
{
 
    public function index(Email $email)
    {
       return Email::all();
    }

 
    public function create()
    {
        
    }


    public function store(EmailRequest $request)
    {
       $email = Email::create($request->all());
       return $email;
    }


    public function show($id)
    {
        $email = Email::where('id', $id)->first();

        return $email;
    }


    public function edit(Email $email)
    {
        return $email;
    }


    public function update(EmailRequest $request, Email $email)
    {
        $email -> update($request->all());
        return $email;
    }


    public function destroy(Email $email)
    {
        return ['status' => $email->delete()];
    }
    public function changeActive(Request $request, $id){
        
        $email = Email::find($id);
        if($email->active)
        {
            $email->update(['active' => false]);
              
        }   else    {
            $email->update(['active' => true]);
        }
     return ['status' => 1];
    }
}
