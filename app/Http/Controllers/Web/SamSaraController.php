
<?php

namespace Vanguard\Http\Controllers;

use Illuminate\Http\Request;

class SamSaraController extends Controller
{
    public function speed(Request $request)
    {
        $rawPayload = file_get_contents('php://input');

        $webhookKey = 'jrpTenn/+QvOhAKa9VvvyB8y+8s=';

        $computedSignatureKey = base64_encode(
            hash_hmac('sha256, $rawPayload, $webhookKey, true')
        );

        $samsaraSignatureKey = $_SERVER['secret'];

        $isEqual = false;

        if(hash_equals($computedSignatureKey, $samsaraSignatureKey)){
            $isEqual = true;
            http_response_code(200);
            //database entry
        }else{
            http_response_code(401);
        }
    }
}