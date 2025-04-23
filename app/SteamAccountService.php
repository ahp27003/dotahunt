<?php

namespace App;

use App\Jobs\consumeOpendotaApi;
use GuzzleHttp\Client;
use Laravel\Socialite\Contracts\User as ProviderUser;

class SteamAccountService
{
    public function findOrCreate(ProviderUser $providerUser, $provider)
    {
        // dd($providerUser->getId());
        $account = LinkedSteamAccount::where('provider_name', $provider)
            ->where('provider_id', $providerUser->getId())
            ->first();

        if ($account) {
            return $account->user;
        } else {

            $user = auth()->user();

            $dotaId = $providerUser->getId() - 76561197960265728;

            //coding for opendota api
            $client = new Client(['base_uri'
            => 'https://api.opendota.com/api/']);

            $response = $client->get("players/$dotaId");
            $fetchPlayers = json_decode($response->getBody(), true);


            $response2 = $client->get("players/$dotaId/wl");
            $fetchWL = json_decode($response2->getBody(), true);

            $user->accounts()->create([
                'provider_id'   => $providerUser->getId(),
                'provider_name' => $provider,
                'dota_id' => $dotaId,
                'profile_url' => $providerUser->user['profileurl'],
                'avatar_url' => $providerUser->user['avatarfull'],
                'steam_name' => $providerUser->user['personaname'],
                'mmr' => $fetchPlayers['solo_competitive_rank'],
                'medal' => $fetchPlayers['rank_tier'],
                'leaderboard_rank' => $fetchPlayers['leaderboard_rank'],
                'country' => $providerUser->user['loccountrycode'],
                'win_lose' => $fetchWL,
            ]);

            consumeOpendotaApi::dispatch($user);
            return $user;
        }
    }
}
