<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
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
            return redirect()->intended('dashboard');
        }else{
            return 'tidak masuk';   
            // return 'tidak masuk';
        }
    }

    public function ams(){
        // AMS
        $token_ams = 'iCI0YUAb0hu+2HF62lR_xs9FUsguF3OI6BqU2O33vP46fq$AO42UAE647vCeu4Shxfw';
        $ams_response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token_ams,
        ])->get('https://ams.karyaoptima.com/api/public/get-token/'.Auth::user()->id_user);
        $data_ams = $ams_response->json();
        if(isset($data_ams['result']['access_token'])){
            $ams_access_token = $data_ams['result']['access_token'];
            session()->put('ams_token', $ams_access_token);
            return redirect()->to('https://ams.karyaoptima.com/sso/' . $ams_access_token);
        }else{
            return redirect()->route('dashboard')->with('error', 'You doesn`t have AMS account !, Please Contact HRD for confirmation');
        }
        // END AMS
    }

    public function ims(){
        // AMS
        $token_ims = 'KFhNebzV8EvLWTyWYZ0XPKafNGDwtANTN7WzZtka_TfGTqPQtmANLiRfMtCI8JKyxg9';
        $ims_response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token_ims,
        ])->get('https://api-ims.karyaoptima.com/public/get-token/'. Auth::user()->id_user);
        $data_ims = $ims_response->json();
        $ims_access_token = $data_ims['result']['access_token'];
        if(isset($data_ims['result']['access_token'])){
            $ims_access_token = $data_ims['result']['access_token'];
            // session()->put('ims_token', $ims_access_token);
            return redirect()->to('https://ims.karyaoptima.com/sso/' . $ims_access_token);
        }else{
            return redirect()->route('dashboard')->with('error', 'You doesn`t have IMS account !, Please Contact HRD for confirmation');
        }
        // END AMS
    }
    public function aas(){
        return redirect()->route('dashboard')->with('error', 'Still Under Development !');
    }
    public function hris(){

        $token = bin2hex(random_bytes(16));

        $users = DB::table('tb_user')->where('id_user', Auth::user()->id_user)->update([
            'session_token' => $token,
        ]);
        
        setcookie("session_token", $token, time() + 3600, "/", ".triasmitra.com");
        setcookie("id_user", Auth::user()->id_user, time() + 3600, "/", ".triasmitra.com");
        setcookie("id_peg", Auth::user()->id_peg, time() + 3600, "/", ".triasmitra.com");
        setcookie("hak_akses", Auth::user()->hak_akses, time() + 3600, "/", ".triasmitra.com");

        
        return redirect()->to('https://hrisportal.triasmitra.com/pages/pegawai/');
        
    }

    public function underdevelopment(){
        return redirect()->route('dashboard')->with('error', 'Still under development !');
    }

    public function profile(){

        $pegawai = DB::table('tb_pegawai')->where('nik', Auth::user()->id_user)->get()->first();
        return view('profile')->with('pegawai', $pegawai);
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
