<?php

namespace Vanguard\Http\Controllers\Web;
use Vanguard\Http\Controllers\Controller;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class PaAssistController extends Controller
{
    public function index ()
    {


        $client = new \GuzzleHttp\Client();
        $request = $client->request('GET', 'http://paassist.online:8153/api.rsc/PAAssistTest_dbo_tblPatient/',
            [
                'headers' => ['x-cdata-authtoken' => '3t7Z5b9b3W5n4m2C0u9r']
            ]);

        if($request->getStatusCode() == 200)
        {
            $body = json_decode((string) $request->getBody(), true);

            $collection = collect($body['value'])->map(function($patient){
                return[
                    'guid' => $patient['RecGuid'],
                    'patient_type' => $patient['PatientTypeId'],
                    'first_name' => $patient['FirstName'],
                    'last_name' => $patient['LastName']
                ];
            });

            return view('patients.test', compact('collection'));
        }else{
            dd('Error');
        }
    }
}
