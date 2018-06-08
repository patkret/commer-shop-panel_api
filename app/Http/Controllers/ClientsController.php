<?php

namespace App\Http\Controllers;

use App\Client;
use App\ClientDiscount;
use App\Http\Requests\ClientPasswordRequest;
use App\Http\Requests\ClientRequest;
use App\Mail\deleteAccount;
use App\Mail\setPassword;
use App\ShippingDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Mail\Register;
use Illuminate\Support\Facades\Mail;
use App\Log;
use GusApi\Exception\InvalidUserKeyException;
use GusApi\GusApi;
use GusApi\ReportTypes;
use Illuminate\Support\Facades\Route;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();

        return $clients;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Client $client
     * @return array
     */
    public function store(Request $request, Client $client)
    {
        $data = $request->all();
        $temporary_password = str_random(8);
        $data['password'] = bcrypt($temporary_password);
        $data['status'] = 1;

        $confirmation_code = str_random(30);

        $created = $client->create($data);
        $shipping_info = $request->shipping_details;
        $shipping_info['client_id'] = $created->id;
        ShippingDetail::create($shipping_info);

//        Log::createNew($client->module_id, $created->first_name . ' ' . $created->last_name, 'add');

        Mail::to($created->email)->send(new setPassword($created->id, $confirmation_code, $temporary_password));

        return $created;

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Client::find($id);

        return $client;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Client $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $data = $request->all();

        unset($data['password']);
        print_r($data);

        $client->update($data);

        return ['status' => 1];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Client::find($id)->delete();

        return ['status' => 1];
    }

    public function register(Request $request)
    {

        $data = $request->all();
        $confirmation_code = str_random(30);
        $data['confirmation_code'] = $confirmation_code;
        $data['status'] = 0;
        $data['password'] = bcrypt($data['password']);

        $created = Client::create($data);
        Mail::to($created->email)->send(new Register($created->confirmation_code));

        return response()->JSON(['message' => 'Successfully registered']);
    }

    public function searchInGus(Request $request)
    {
        $gus = new GusApi(env('GUS_KEY'));

        try {
            $nipToCheck = $request->all()['NIP'];
            $id = $gus->login();


            $gusReport = $gus->getByNip($id, $nipToCheck);

            $gusReport =$gusReport[0];
//                        foreach ($gusReports as $gusReport) {
//                //you can change report type to other one
//                $reportType = ReportTypes::REPORT_ACTIVITY_PHYSIC_OTHER_PUBLIC;
//                echo $gusReport->getName();
//                $fullReport = $gus->getFullReport($gusReport, $reportType);
//                var_dump($fullReport);
//            }

            $company = [
                'company' => $gusReport->getName(),
                'city' => $gusReport->getCity(),
                'zip_code' => $gusReport->getZipCode(),
                'street' => $gusReport->getStreet(),
            ];

            return $company;

        } catch (InvalidUserKeyException $e) {
            echo 'Bad user key';
        } catch (\GusApi\Exception\NotFoundException $e) {
            echo 'No data found <br>';
            echo 'For more information read server message below: <br>';
            echo $e->getMessage();
        }
    }

    public function checkIfClientExists(Request $request)
    {

        $input = $request->nipToCheck;

        $client = Client::where('NIP', 'LIKE', '%' . $input . '%')
            ->limit(5)
            ->get();

        return $client;
    }

    public function confirm($confirmation_code)
    {

        $client = Client::where('confirmation_code', $confirmation_code)->first();

        if ($client->status === 0) {
            $if_confirmed = 0;
            $client->update(['status' => 1]);

        } else {
            $if_confirmed = 1;
        }
        return view('confirm', compact('if_confirmed'));
    }

    public function setPasswordView()
    {

        $client_id = Route::current()->parameter('client_id');
        $client = Client::where('id', $client_id)->first();

        if (Carbon::now()->greaterThan($client->created_at->addMinute())) {

            return "Link do zmiany hasła wygasł. Prosimy zaloguj się tymczasowym hasłem i w swoim panelu ustaw nowe hasło";

        } else {

            return view('setPasswordForm', compact('client_id'));
        }

    }

    public function setPassword(ClientPasswordRequest $request, $client_id)
    {

        $newPassword = bcrypt($request->password);

        Client::where('id', $client_id)->update(['password' => $newPassword]);

        return redirect('welcome')->with('message', 'Nowe hasło zostało ustawione');
    }

    public function deleteAccountConfirm($id)
    {
        $client_mail = Client::where('id', $id)->first()->email;

        Mail::to($client_mail)->send(new deleteAccount($id));
    }

    public function deleteAccount($id)
    {

        if (Client::where('id', $id)->first()) {

            Client::where('id', $id)->delete();

            $msg = "Twoje konto zostało usunięte!";


        } else {

            $msg = 'Twoje konto zostało już wcześniej usunięte';
        }

        return view('deleteAccountInfo', compact('msg'));
    }

    public function addClientDiscount(Request $request){

        $discount = ClientDiscount::create($request->all());

        return $discount;

    }

    public function getClientDiscounts($client_id){

        $client = Client::with('discounts')->where('id', $client_id)->get();

        return $client;
    }
}
