<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Auth;

class UserController extends Controller
{

    public function google()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback()
    {
        $callback =  Socialite::driver('google')->stateless()->user();

        $data = [
            'name'              => $callback->getName(),
            'email'             => $callback->getEmail(),
            'avatar'            => $callback->getAvatar(),
            'is_admin'          => 0,
            'email_verified_at' => date('Y-m-d H:i:s', time())
        ];

        $user = User::whereEmail($data['email'])->first();
        if(!$user) {
            $user = User::create($data);
            // Mail::to($user->email)->send(new AfterRegister($user));
        }
        Auth::login($user, true);

        return redirect(route('welcome'));
    }
}
