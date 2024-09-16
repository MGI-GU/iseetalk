<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from provider.  Check if the user already exists in our
     * database by looking up their provider_id in the database.
     * If the user exists, log them in. Otherwise, create a new user then log them in. After that
     * redirect them to the authenticated users homepage.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        try {
        	$user = Socialite::driver($provider)->user();
        	$authUser = $this->findOrCreateUser($user, $provider);
            Auth::login($authUser, true);
            if(auth()->user()->name == null || auth()->user()->phone == null){
        	    return redirect('/setting');
            }
        	return redirect('/');
	    } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    /**
     * If a user has registered before using social auth, return the user
     * else, create a new user object.
     * @param  $user Socialite user object
     * @param $provider Social auth provider
     * @return  User
     */
    public function findOrCreateUser($user, $provider)
    {
        $authUser = User::where('provider_id', $user->id)->first();
        if ($authUser) {
            return $authUser;
        }else{
            $data = User::create([
                'avatar'        => $user->avatar,
                'name'          => strip_tags($user->name),
                'email'         => !empty($user->email)? strip_tags($user->email) : '' ,
                'type'          => 'member',
                'provider'      => strip_tags($provider),
                'provider_id'   => strip_tags($user->id)
            ]);
            return $data;
        }
    }
}