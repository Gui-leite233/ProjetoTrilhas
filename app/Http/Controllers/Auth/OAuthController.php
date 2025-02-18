<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Google_Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class OAuthController extends Controller
{
    private $client;

    public function __construct()
    {
        $this->client = new Google_Client();
        $this->client->setClientId(env('MAIL_PASSWORD'));
        $this->client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $this->client->setRedirectUri(env('APP_URL') . '/oauth2callback');
        $this->client->addScope('email');
        $this->client->addScope('profile');
    }

    public function redirectToGoogle()
    {
        return redirect($this->client->createAuthUrl());
    }

    public function handleGoogleCallback(Request $request)
    {
        try {
            $token = $this->client->fetchAccessTokenWithAuthCode($request->get('code'));
            $this->client->setAccessToken($token);

            $google_oauth = new \Google_Service_Oauth2($this->client);
            $google_account_info = $google_oauth->userinfo->get();

            $user = User::where('email', $google_account_info->email)->first();

            if (!$user) {
                $user = User::create([
                    'name' => $google_account_info->name,
                    'email' => $google_account_info->email,
                    'password' => Hash::make(Str::random(24)),
                    'google_id' => $google_account_info->id,
                    'email_verified_at' => now(),
                ]);
            }

            Auth::login($user);
            return redirect()->route('dashboard');

        } catch (\Exception $e) {
            return redirect()->route('login')
                ->with('error', 'Erro na autenticação com Google. Por favor, tente novamente.');
        }
    }
}
