<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Google_Client;
use Google\Service\Oauth2;

class GoogleController extends Controller
{
    protected $client;

    public function __construct()
    {
        $this->client = new Google_Client();
        $this->client->setClientId(config('services.google.client_id'));
        $this->client->setClientSecret(config('services.google.client_secret'));
        $this->client->setRedirectUri(config('services.google.redirect'));
        $this->client->addScope('email');
        $this->client->addScope('profile');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        return redirect($this->client->createAuthUrl());
    }

    /**
     * Handle Google callback
     *
     * @return \Illuminate\Http\Response
     */
    public function handleGoogleCallback(Request $request)
    {
        try {
            if ($request->has('code')) {
                $token = $this->client->fetchAccessTokenWithAuthCode($request->code);
                $this->client->setAccessToken($token);

                $oauth2 = new Oauth2($this->client);
                $userInfo = $oauth2->userinfo->get();

                $finduser = User::where('google_id', $userInfo->id)->first();

                if ($finduser) {
                    Auth::login($finduser);
                    return redirect()->intended('/dashboard');
                } else {
                    $newUser = User::create([
                        'name' => $userInfo->name,
                        'email' => $userInfo->email,
                        'google_id' => $userInfo->id,
                        'password' => bcrypt(str_random(16))
                    ]);

                    Auth::login($newUser);
                    return redirect()->intended('/dashboard');
                }
            }

            return redirect()->route('login')->with('error', 'Google authentication failed');
        } catch (Exception $e) {
            return redirect()->route('login')->with('error', 'Something went wrong with Google login');
        }
    }
} 