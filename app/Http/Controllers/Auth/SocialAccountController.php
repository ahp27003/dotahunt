<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SteamAccountService;

class SocialAccountController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return \Socialite::driver('steam')->redirect();
    }

    /**
     * Obtain the user information
     *
     * @return Response
     */
    public function handleProviderCallback(SteamAccountService $accountService)
    {

        $provider = 'steam';

        try {
            $user = \Socialite::with('steam')->user();
        } catch (\Exception $e) {
            return redirect('/steamconnects');
        }


        //dd($user);

        if(isset($user->user['loccountrycode']) == false){
            return redirect('/steamconnects')->withError('Please select your country in your steam profile and try again.');
        }
        if($user->user['loccountrycode'] != "MY"){
            return redirect('/steamconnects')->withError('Only Malaysian player can use this service, Please check your country in steam profile.');
        }



        $authUser = $accountService->findOrCreate($user,$provider);

        //auth()->login($authUser, true);
        //dd($authUser->accounts->dota_id);

        //dd(auth()->user());

            if(auth()->user() == $authUser)
            {
                return redirect()->to('/players/' . $authUser->accounts->dota_id);

            }
            else{
                return redirect('/steamconnects')->withError('Steam account that you trying to connect already in used!');
            }






    }
}
