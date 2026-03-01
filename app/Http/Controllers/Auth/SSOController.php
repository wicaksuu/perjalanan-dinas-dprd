<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\AbstractProvider;
use Illuminate\Support\Str;

class SSOController extends Controller
{
    /**
     * Redirect the user to the Madiun Kab authentication page.
     */
    public function redirect()
    {
        return Socialite::buildProvider(
            \App\Socialite\MadiunKabProvider::class,
            config('services.madiunkab')
        )
        ->redirect();
    }

    /**
     * Obtain the user information from Madiun Kab.
     */
    public function callback()
    {
        try {
            $ssoUser = Socialite::buildProvider(
                \App\Socialite\MadiunKabProvider::class,
                config('services.madiunkab')
            )
            ->user();

            // Find or create user
            $user = User::where('sso_id', $ssoUser->getId())
                ->orWhere('email', $ssoUser->getEmail())
                ->first();

            if (!$user) {
                // Auto-register if user doesn't exist
                $user = User::create([
                    'name' => $ssoUser->getName() ?? $ssoUser->getNickname() ?? 'SSO User',
                    'email' => $ssoUser->getEmail(),
                    'password' => bcrypt(Str::random(16)), // Required by DB but not used for SSO
                    'sso_id' => $ssoUser->getId(),
                    'sso_provider' => 'madiunkab',
                ]);
            } else {
                // Update existing user with SSO info
                $user->update([
                    'sso_id' => $ssoUser->getId(),
                    'sso_provider' => 'madiunkab',
                    'sso_token' => $ssoUser->token,
                ]);
            }

            Auth::login($user);

            return redirect()->intended('/dashboard');

        } catch (\Exception $e) {
            return redirect('/login')->withErrors(['login' => 'Gagal login menggunakan SSO Madiun Kab.']);
        }
    }
}
