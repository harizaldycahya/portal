<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Log;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = [
            'id_user' => $request->input('username'),
            'password' => $request->input('password'),
        ];

        $user = \App\Models\User::where('id_user', $credentials['id_user'])->first();

        if ($user && $user->password === md5($credentials['password'])) {
            Auth::login($user);
            

            // AMS
            $token_ams = 'iCI0YUAb0hu+2HF62lR_xs9FUsguF3OI6BqU2O33vP46fq$AO42UAE647vCeu4Shxfw';
            $ams_response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token_ams,
            ])->get('https://ams.karyaoptima.com/api/public/get-token/'.$credentials['id_user']);
            $data_ams = $ams_response->json();
            if(isset($data_ams['result']['access_token'])){
                $ams_access_token = $data_ams['result']['access_token'];
                session()->put('ams_token', $ams_access_token);
            }
            // END AMS

            // IMS
            // $token_ims = 'KFhNebzV8EvLWTyWYZ0XPKafNGDwtANTN7WzZtka_TfGTqPQtmANLiRfMtCI8JKyxg9';
            // $ims_response = Http::withHeaders([
            //     'Authorization' => 'Bearer ' . $token_ims,
            // ])->get('https://api-ims.karyaoptima.com/api/public/get-token/'.$credentials['id_user']);
            // $data_ims = $ims_response->json();
            // return $data_ims;
            // $ims_access_token = $data_ims['result']['access_token'];
            // session()->put('ims_token', $ims_access_token);
            // END IMS

            return redirect()->intended('dashboard');
        }else{
            return 'tidak masuk';   
            // return 'tidak masuk';
        }
    }

    public function dashboard(){
        return view('dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
}
