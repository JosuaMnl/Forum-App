<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite as Socialite;

class SocialController extends Controller
{
    public function redirect($provider) {
        return Socialite::driver($provider)->redirect();
    }

    public function Callback($provider) {
        $userSocial = Socialite::driver($provider)->stateless()->user();

        $users = User::where(['email' => $userSocial->getEmail()])->first();

        if ($users) {
            Auth::login($users);
            return redirect()->route('discussions.index');
        } else {
            $user = User::create([
                'username' => $userSocial->getName(),
                'email' => $userSocial->getEmail(),
                'picture' => $userSocial->getAvatar(),
                'provider' => $provider,
                'provider_id' => $userSocial->getId(),
            ]);
            return redirect()->route('home');
        }
    }

}
