<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SsoLoginController extends Controller
{
    public function getLogin(Request $request)
    {
        $request->session()->put('state', $state = \Str::random(40));

        $request->session()->put(
            'code_verifier', $code_verifier = \Str::random(128)
        );

        $codeChallenge = strtr(rtrim(
            base64_encode(hash('sha256', $code_verifier, true))
            , '='), '+/', '-_');

        $query = http_build_query([
            'client_id' => config('config.system2_sso_client_id'),
            'redirect_uri' => config('config.callback'),
            'response_type' => 'code',
            'scope' => '',
            'state' => $state,
            'code_challenge' => $codeChallenge,
            'code_challenge_method' => 'S256',
            'user_id'=>auth()->user()->id,
        ]);

        return redirect(config('config.system2_host') .  '/oauth/authorize?' . $query);
    }

    public function getCallback(Request $request)
    {
        $state = $request->session()->pull('state');

        $codeVerifier = $request->session()->pull('code_verifier');

        throw_unless(
            strlen($state) > 0 && $state === $request->state,
            \InvalidArgumentException::class
        );


        $response = Http::asForm()->post(config('config.system2_host').'/oauth/token', [
            'grant_type' => 'authorization_code',
            'client_id' => config('config.system2_sso_client_id'),
            'redirect_uri' => config('config.callback'),
            'code_verifier' => $codeVerifier,
            'code' => $request->code,
        ]);

        if ($response->failed()) {
            \Alert::error('Error Has Occurred', $response->reason());
            return redirect('dashboard');
        }

        \Alert::success('SSO Login',"SSO Login Worked ".$response->json('access_token'));
        return redirect('dashboard');
    }
}
