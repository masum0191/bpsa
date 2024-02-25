<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Member;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
    
    public function user(){
        return view('admin.user');
    }
    
     public function pverify(Request $request){
    //     $member=User::where('UniqueID',$request->PIMS_ID)->first();
    //     if($member){
    //     $res = [
    //     'massege' => 'You Already Registered ! ',
    //     'value'   =>3 ,            
    // ];
    //     }
    //     else{
    //     $pmsid = array("BP700101283", "BP770512132", "BP750510460", "BP790611390", "BP803276897");
    //     $searchValue = $request->PIMS_ID; // The value you want to search for
    //     // dd($request->PIMS_ID);
    //     in_array($searchValue, $pmsid);
    //     $index = \DB::table('bps')->where('bpn',$request->PIMS_ID)->where('birth',$request->birth)->first();
        //dd($index);
        //$token = $searchValue->createToken('apiToken')->plainTextToken;
         
    $phone=$request->mobile;   
    if($phone){
    $otp  = rand(293,50979);
    
    $url = "http://bulksmsbd.net/api/smsapi";
    $api_key = "aERc4bxxJO0ucVDk1gjm";
    $senderid = "8809617611074";
    $number = $phone;
    $message = "Your Verification Code ".$otp;
 
    $data = [
        "api_key" => $api_key,
        "senderid" => $senderid,
        "number" => $number,
        "message" => $message
    ];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);
    curl_close($ch);
   // return $response;
    $res = [
        'otp' => $otp,
        
        'phone' => $phone,
        'value'   =>1,         
    ];
        }else{
    $res = [
        'massege' => 'No matching PIMS_ID',
        'value'   =>2 ,            
    ];
}      

        return response($res, 200);
    }
public function forgetpass(Request $request){
    
    $member=Member::where('BPID',$request->PIMS_ID)->first();
    if ($member) {
    //$otp  = rand(293,50979);
   // $name=$member->name;
    //$phone=$member->phone;
    
    // $url = "http://bulksmsbd.net/api/smsapi";
    // $api_key = "aERc4bxxJO0ucVDk1gjm";
    // $senderid = "8809617611074";
    // $number = $phone;
    // $message = "Your Verification Code ".$otp;
 
    // $data = [
    //     "api_key" => $api_key,
    //     "senderid" => $senderid,
    //     "number" => $number,
    //     "message" => $message
    // ];
    // $ch = curl_init();
    // curl_setopt($ch, CURLOPT_URL, $url);
    // curl_setopt($ch, CURLOPT_POST, 1);
    // curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    // $response = curl_exec($ch);
    // curl_close($ch);
    $res = [
        'name'=>$member->name,
        'massege' => "You have Valid User",
        'value'   =>1,         
    ];
        }else{
    $res = [
        'massege' => 'No matching PIMS ID',
        'value'   =>2 ,            
    ];
} 




        return response($res, 200);
    }

public function pverify1(Request $request){       
        $searchValue = $request->PIMS_ID;//dd($searchValue);
        // $curl = curl_init();        
        // curl_setopt_array($curl, array(
        //   CURLOPT_URL => 'https://pims.police.gov.bd:8443/pimslive/webpims/oauth/token',
        //   CURLOPT_RETURNTRANSFER => true,
        //   CURLOPT_ENCODING => '',
        //   CURLOPT_MAXREDIRS => 10,
        //   CURLOPT_TIMEOUT => 0,
        //   CURLOPT_FOLLOWLOCATION => true,
        //   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //   CURLOPT_CUSTOMREQUEST => 'POST',
        //   CURLOPT_POSTFIELDS => 'grant_type=client_credentials',
        //   CURLOPT_HTTPHEADER => array(
        //     'Content-Type: application/x-www-form-urlencoded',
        //     'Authorization: Basic aXB6RTZ3cWhQbWVFRC1FVjNsdlBVQS4uOlpJQnRBZk1rZnVLS1lxWnRiaWstVEEuLg=='
        //   )
        // ));        
        // $response = curl_exec($curl);
        
        // curl_close($curl);
        //$res->getBody()
       // $token=json_decode($response);
       //dd($token->access_token);   
//         $curl = curl_init();
//         $baseURL = 'https://pims.police.gov.bd:8443/pimslive/webpims/asp-info/';
//         $dynamicValue = "$searchValue"; // Replace this with your dynamic value
                
//         $fullURL = $baseURL . $dynamicValue;
//         curl_setopt_array($curl, array(
//         CURLOPT_URL => $fullURL,
//         CURLOPT_RETURNTRANSFER => true,
//         CURLOPT_ENCODING => '',
//         CURLOPT_MAXREDIRS => 10,
//         CURLOPT_TIMEOUT => 0,
//         CURLOPT_FOLLOWLOCATION => true,
//         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//         CURLOPT_CUSTOMREQUEST => 'GET',
//         CURLOPT_HTTPHEADER => array(
//         'Authorization: Bearer "NZ-MNOT8du5BQqhD8vCXJw"'
//   ),
// ));

// $response = curl_exec($curl);

// curl_close($curl);
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://pims.police.gov.bd:8443/pimslive/webpims/asp-info/BP7003027838',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer NZ-MNOT8du5BQqhD8vCXJw'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
dd($response) ;
//return response ($response,200) ; 
        
    }
    public function sign_up(Request $request){
        $data = $request->validate([
            'name' => 'required|string',
            'UniqueID' => 'required|string',
            'email' => 'required|string|unique:members,UserID',
            'password' => 'required|confirmed',
             
            
        ]);

        $user = Member::create([
            'Name' => $data['name'],
            'BPID' => $data['UniqueID'],
            'UserID' => $data['email'],
            'MemberRole'  =>'member',
            'password' => bcrypt($data['password'])
        ]);

        //$token = $user->createToken('apiToken')->plainTextToken;

        $res = [
            'masage' => 'Member Create Successfully',
            
            
        ];
        return response($res, 201);
    }

    // app login menber
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = Member::where('UserID', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response([
                'msg' => 'incorrect username or password'
            ], 401);
        }

        $token = $user->createToken('apiToken')->plainTextToken;

        $res = [
            'user' => $user,
            'token' => $token
        ];

        return response($res, 201);
    }
    public function profile_update(Request $request,$mid)
    {
        

        $user = Member::where('id', $mid)->first();
         $b_member=\DB::table('back_members')->insert([
            'member_id'=>$user->id,
            'Name'=>$user->Name,
            'BPID'=>$user->BPID,
            'password'=>$user->password,
            'MemberRole'=>$user->MemberRole,
            'image'=>$user->image,
            'CoCurriculumActivities'=>$user->CoCurriculumActivities,
            ]);
        $user->image=$request->image;
        $user->CoCurriculumActivities=$request->CoCurriculumActivities;
        $user->save();
        if($user->save()){
        $res = [
            'massege' => 'Member Profile is Update',
        ];
        }else{
           $res = [
            'massege' => 'Member Profile is Not Update',
        ]; 
        }

        return response($res, 201);
    }
     public function profile(Request $request,$bpsid)
    {
         $user = Member::where('BPID', $bpsid)->first();

       // $user = \DB::table('members')->where('bpn', $bpsid)->first();
      
       
        $res = [
            'member' => $user,
            'massege' => "success"
        ];
        return response($res, 201);
    }
public function pmsdata(Request $request){
    return 1;
    $member=User::where('UniqueID',$request->PIMS_ID)->first();
    return response($member, 200);
    
}
    public function change_pass1(Request $request)
    {
        

        $user = User::where('UniqueID', $request->uniqueId)->first();
        
        $user->password= bcrypt($request->Newpassword);
        $user->save();
        if($user->save()){
        $res = [
            'massege' => 'Member Password  is change',
        ];
        }else{
           $res = [
            'massege' => 'Wrong ',
        ]; 
        }

        return response($res, 201);
    }
public function change_pass(Request $request)
{
   // return 1;
   //return response($request->current_password, 201); 
    // $request->validate([
    //     'current_password' => 'required',
    //     'password' => 'required|confirmed',
    // ]);

    $user = Member::where('BPID', $request->UniqueID)->first();

    if ($user){
        $b_member=\DB::table('back_members')->insert([
            'member_id'=>$user->id,
            'Name'=>$user->Name,
            'BPID'=>$user->BPID,
            'password'=>$user->password,
            'MemberRole'=>$user->MemberRole,
            'image'=>$user->image,
            'CoCurriculumActivities'=>$user->CoCurriculumActivities,
            ]);
        $user->password = bcrypt($request->newpassword);
        $user->save();
       
       $res = [
            'massege' => 'Password changed successfully.',
        ];
       
    }else{
        $res = [
            'massege' => 'Incorrect current password.',
        ];  
    }

   
     return response($res, 201);
}
public function changepasswordmember(Request $request)
{
    //return 1;
   //return response($request->current_password, 201); 
    $request->validate([
        'current_password' => 'required',
        'password' => 'required|confirmed',
    ]);

    $user = Member::where('BPID', $request->uniqueId)->first();

    if (Hash::check($request->current_password,$user->password)) {
        $b_member=\DB::table('back_members')->insert([
            'member_id'=>$user->id,
            'Name'=>$user->Name,
            'BPID'=>$user->BPID,
            'password'=>$user->password,
            'MemberRole'=>$user->MemberRole,
            'image'=>$user->image,
            'CoCurriculumActivities'=>$user->CoCurriculumActivities,
            ]);
        $user->password = bcrypt($request->password);
        $user->save();

       // return redirect()->back()->with('success', 'Password changed successfully.');
       $res = [
            'massege' => 'Password changed successfully.',
        ];
       
    }else{
        $res = [
            'massege' => 'Incorrect current password. ',
        ];  
    }

   
     return response($res, 201);
}
function makeApiRequest1() {
    $accessTokenUrl = 'https://pims.police.gov.bd:8443/pimslive/webpims/oauth/token';
    $clientId = 'ipzE6wqhPmeED-EV3lvPUA..';
    $clientSecret = 'ZIBtAfMkfuKKYqZtbik-TA..';

    $response = Http::withHeaders([
        'Authorization' => 'Basic ' . base64_encode($clientId . ':' . $clientSecret),
    ])->post($accessTokenUrl, [
        'grant_type' => 'client_credentials',
    ]);

    $accessToken = $response->json()['access_token'];

    // Now you can use the $accessToken to make further API requests
    // For example:
    $apiUrl = 'https://pims.police.gov.bd:8443/pimslive/webpims/asp-info/:bpno';
    $apiResponse = Http::withToken($accessToken)->get($apiUrl);

    return $apiResponse->json();
}


function makeApiRequest() {
    $client = new \GuzzleHttp\Client();
    $accessTokenUrl = $client->request('GET', 'https://pims.police.gov.bd:8443/pimslive/webpims/oauth/token');
    $clientId = 'ipzE6wqhPmeED-EV3lvPUA..';
    $clientSecret = 'ZIBtAfMkfuKKYqZtbik-TA..';

    $response = Http::withHeaders([
        'Authorization' => 'Basic ' . base64_encode($clientId . ':' . $clientSecret),
    ])->post($accessTokenUrl, [
        'grant_type' => 'client_credentials',
    ]);

    $accessToken = $response->json()['access_token'];

    return $accessToken;
}




function getAccessToken() {
   $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://pims.police.gov.bd:8443/pimslive/webpims/oauth/token',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => 'grant_type=client_credentials',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/x-www-form-urlencoded',
    'Authorization: Basic aXB6RTZ3cWhQbWVFRC1FVjNsdlBVQS4uOlpJQnRBZk1rZnVLS1lxWnRiaWstVEEuLg=='
  ),
));

$response = curl_exec($curl);

curl_close($curl);
//echo $response;




curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://pims.police.gov.bd:8443/pimslive/webpims/asp-info/BP7003027838',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer '.$response.''
  ),
));

$response1 = curl_exec($curl);

curl_close($curl);
 $bpInformation = json_decode($response1->getBody(), true);
dd ($bpInformation);


}


}
