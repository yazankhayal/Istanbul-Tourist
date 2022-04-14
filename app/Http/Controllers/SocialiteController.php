<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use Illuminate\Support\Facades\Auth;

class SocialiteController extends Controller
{
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        try {
            $user = Socialite::driver('facebook')->user();
        }
        catch (\Exception $e) {
            return redirect()->to('/login')->with('error','Error Auth');
        }
        // check if they're an existing user
        $existingUser = User::where('email', $user->email)->first();
        if($existingUser){
            if($existingUser->type_login == 'facebook'){
                auth()->login($existingUser, true);
                return redirect()->to('/home')->with('success','Login through facebook');
            }
            else{
                return redirect()->to('/login')->with('error','Error Auth');
            }
        }
        else {
            // create a new user
            $newUser  = new User;
            $newUser->name   = $user->name;
            $newUser->email  = $user->email;
            $newUser->avatar = $user->avatar;
            $uuid =parent::RandomOrderId(10);
            $newUser->password = bcrypt($uuid);
            $newUser->other_id  = $user->id;
            $newUser->token  = $user->token;
            $newUser->type_login  = 'facebook';
            $newUser->role = 2;
            $newUser->active = 1;
            $newUser->save();
            auth()->login($newUser, true);
            return redirect()->to('/home')->with('success','Login through facebook');
        }
    }

    public function redirectToLinkedin()
    {
        return Socialite::driver('linkedin')->redirect();
    }

    public function handleLinkedinCallback()
    {
        try {
            $user = Socialite::driver('linkedin')->user();
        }
        catch (\Exception $e) {
            return redirect()->to('/login')->with('error','Error Auth');
        }

        // check if they're an existing user
        $existingUser = User::where('email', $user->email)->first();
        if($existingUser){
            if($existingUser->type_login == 'linkedin'){
                auth()->login($existingUser, true);
                return redirect()->to('/home')->with('success','Login through linkedin');
            }
            else{
                return redirect()->to('/login')->with('error','Error Auth');
            }
        } else {
            // create a new user
            $newUser  = new User;
            $newUser->name   = $user->name;
            $newUser->email  = $user->email;
            $newUser->avatar = $user->avatar;
            $uuid =parent::RandomOrderId(10);
            $newUser->password = bcrypt($uuid);
            $newUser->other_id  = $user->id;
            $newUser->token  = $user->token;
            $newUser->type_login  = 'linkedin';
            $newUser->role = 2;
            $newUser->active = 1;
            $newUser->save();
            auth()->login($newUser, true);
            return redirect()->to('/home')->with('success','Login through linkedin');
        }
    }

    public function redirectToGoogle(){
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(){
        try {
            $user = Socialite::driver('google')->user();
        }
        catch (\Exception $e) {
            return redirect()->to('/login')->with('error','Error Auth');
        }
        // check if they're an existing user
        $existingUser = User::where('email', $user->email)->first();
        if($existingUser){
            if($existingUser->type_login == 'google'){
                auth()->login($existingUser, true);
                return redirect()->to('/home')->with('success','Login through google');
            }
            else{
                return redirect()->to('/login')->with('error','Error Auth');
            }
        }
        else {
            // create a new user
            $newUser  = new User;
            $newUser->name   = $user->name;
            $newUser->email  = $user->email;
            $newUser->avatar = $user->avatar;
            $uuid =parent::RandomOrderId(10);
            $newUser->password = bcrypt($uuid);
            $newUser->other_id  = $user->id;
            $newUser->token  = $user->token;
            $newUser->type_login  = 'google';
            $newUser->role = 2;
            $newUser->active = 1;
            $newUser->save();
            auth()->login($newUser, true);
            return redirect()->to('/home')->with('success','Login through google');
        }
    }

    public function redirectToGitHub(){
        return Socialite::driver('github')->redirect();
    }

    public function handleGitHubCallback(){
        try {
            $user = Socialite::driver('github')->user();
        }
        catch (\Exception $e) {
            return redirect()->to('/login')->with('error','Error Auth');
        }
        // check if they're an existing user
        $existingUser = User::where('email', $user->email)->first();
        if($existingUser){
            if($existingUser->facebook == 'github'){
                auth()->login($existingUser, true);
                return redirect()->to('/home')->with('success','Login through github');
            }
            else{
                return redirect()->to('/login')->with('error','Error Auth');
            }
        } else {
            // create a new user
            $newUser  = new User;
            $newUser->name   = $user->name;
            $newUser->email  = $user->email;
            $newUser->avatar = $user->avatar;
            $uuid =parent::RandomOrderId(10);
            $newUser->password = bcrypt($uuid);
            $newUser->other_id  = $user->id;
            $newUser->token  = $user->token;
            $newUser->type_login  = 'github';
            $newUser->role = 2;
            $newUser->active = 1;
            $newUser->save();
            auth()->login($newUser, true);
            return redirect()->to('/home')->with('success','Login through github');
        }
    }
}
