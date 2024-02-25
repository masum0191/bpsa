<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;

use Illuminate\Support\Facades\Http;
 use GuzzleHttp\Client;
use Illuminate\Http\Request;
class ApiControllers extends Controller
{
    

public function pms1()
{
    


$client = new Client();
$headers = [
  'Content-Type' => 'application/x-www-form-urlencoded',
  'Authorization' => 'Basic aXB6RTZ3cWhQbWVFRC1FVjNsdlBVQS4uOlpJQnRBZk1rZnVLS1lxWnRiaWstVEEuLg=='
];
$options = [
'form_params' => [
  'grant_type' => 'client_credentials'
]];
$request = new Request('POST', 'https://pims.police.gov.bd:8443/pimslive/webpims/oauth/token', $headers);
$res = $client->sendAsync($request, $options)->wait();
echo $res->getBody();


}
public function pms(Request $request){
    $member=User::where('UniqueID',$request->PIMS_ID)->first();
    $res = [
        'massege' => 'Success',
        'value'   =>$member ,            
    ];
    return response($res, 200);
    
}

}