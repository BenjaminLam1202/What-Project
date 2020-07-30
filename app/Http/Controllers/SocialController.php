<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Redirect;
use Response;
use File;
use Socialite;
use App\User;
use App\Mail\QRcode;
use App\Mail\RemakeOTP;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Auth;
use App\Notifications\NewUserNotification;
class SocialController extends Controller
{
    public function redirect ($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback ($provider)
    {
        $google2fa = app('pragmarx.google2fa');
        $getInfo = Socialite::driver($provider)->user();
        $user = User::where('provider_id' ,'=',$getInfo['id'])->first();
        if ($user === null) {
            $secret_key = $google2fa->generateSecretKey();
            $user = $this->createUser($getInfo,$provider,$secret_key);
            // Add the secret key to the registration data




            $qr = $google2fa->getQRCodeInline(
                config('app.name'),
                $user['email'],
                $user['google2fa_secret']
            );



            $data = [
                    'qr' => $qr,
                    'secret' => $user['google2fa_secret'],
            ];

            Mail::to($user)->send(new QRcode($data));
            $user->notify(new NewUserNotification()); 

            Auth()->login($user);
        }
        Auth()->login($user);
        return redirect()->to('/home');

    }

    public function confirmRemake () {
        return view('otp.confirmForgot');
    }

    public function remakeOTP (Request $request)
    {
        $data = $request->all();
        $google2fa = app('pragmarx.google2fa');
        $user = User::where('id' ,'=',Auth::user()->id)->first();

        if ($user != null && Auth::user()->email == $data['email']) {
            $secretKey = $google2fa->generateSecretKey();
            $user['google2fa_secret'] = $secretKey;
            $user->save();
            $qr = $google2fa->getQRCodeInline(
                    config('app.name'),
                    $user['email'],
                    $user['google2fa_secret']
                );
            $data = [
                    'qr' => $qr,
                    'secret' => $user['google2fa_secret'],
            ];
            Mail::to($user)->send(new RemakeOTP($data));
            return redirect()->to('/login');
        }
            return view('otp.makeNewAccount');
    }



    function createUser ($getInfo,$provider,$secret_key) 
    {

        $user = User::where('provider_id', $getInfo['id'])->first();

        if (!$user) {
            $user = User::create([
            'name'     => $getInfo['name'],
            'email'    => $getInfo['email'],
            'provider' => $provider,
            'provider_id' => $getInfo['id'],
            'google2fa_secret' => $secret_key,
            ]);
        }
        return $user;
    }
}
