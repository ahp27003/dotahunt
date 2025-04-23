<?php

namespace App\Jobs;

use App\DotaJson;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class generatePlayerRole implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $roles = DotaJson::first();
        $carry = 0;
        $mid = 0;
        $support = 0;
        $roamer = 0;
        $offlaner = 0;
        //generate player role
        foreach ($this->user->statistic->heroes_played as $playedHero) {
            foreach ($roles->hero_roles as $role) {
                //dd($role['id']);
                if ($playedHero['games'] != 0 and $playedHero['hero_id'] == $role['id']) {
                    if ($role['lane'] == "Midlane" and $role['roles'] == "Carry") {
                        $mid = $mid + $playedHero['games'];
                    } elseif ($role['lane'] == "Safelane" and $role['roles'] == "Carry") {
                        $carry = $carry + $playedHero['games'];
                    } elseif ($role['lane'] == "Safelane" and $role['roles'] == "Support") {
                        $support = $support + $playedHero['games'];
                    } elseif ($role['lane'] == "Safelane" and $role['roles'] == "Roamer") {
                        $roamer = $roamer + $playedHero['games'];
                    } elseif ($role['lane'] == "Offlane" and $role['roles'] == "Tanker") {
                        $offlaner = $offlaner + $playedHero['games'];
                    }
                }
            }
        }


        //generate percentage

        $win = 0;
        $lose = 0;
        $winrate = 0;
        $gpm = 0;
        $counter = 0;
        $xppm = 0;
        $lasthit = 0;
        $hero_dmg = 0;
        $tower_dmg = 0;
        $warding = 0;
        $deward = 0;
        $cw = 0;
        $cd = 0;
        $k = 0;
        $d = 0;
        $a = 0;
        //generate winrate
        foreach ($this->user->matches as $match) {

            foreach ($match->match_details['players'] as $player) {

                if ($this->user->accounts->dota_id == $player['account_id']) {

                    //winrate
                    if ($player['radiant_win'] == true and $player['isRadiant'] == true) {
                        //radian win and user is radiant = win
                        //dd($player['match_id']);
                        $win++;
                    } elseif ($player['radiant_win'] == false and $player['isRadiant'] == false) {
                        //dire win and user is dire = win
                        $win++;
                    } elseif ($player['radiant_win'] == true and $player['isRadiant'] == false) {
                        //radiant win and user is dire = lose
                        $lose++;
                    } elseif ($player['radiant_win'] == false and $player['isRadiant'] == true) {
                        //dire win and user is radiant = lose
                        //dd($player['match_id']);
                        $lose++;
                    }

                    //gpm
                    $gpm += $player['gold_per_min'];
                    //xpm
                    $xppm += $player['xp_per_min'];
                    $lasthit += $player['last_hits'];
                    $hero_dmg += $player['hero_damage'];
                    $tower_dmg += $player['tower_damage'];
                    $k += $player['kills'];
                    $d += $player['deaths'];
                    $a += $player['assists'];

                    if ($player['obs_placed'] != 0) {
                        $warding += $player['obs_placed'];
                        $cw++; //count ward
                    }
                    if ($player['sen_placed'] != 0) {
                        $deward += $player['sen_placed'];
                        $cd++; //count deward
                    }
                    $counter++;
                }
            }
        }

        //count average
        $avg_gpm = number_format(($gpm == 0 ? 0 : ($gpm / $counter)), 0, '.', ',');
        $avg_xppm = number_format(($xppm == 0 ? 0 : ($xppm / $counter)), 0, '.', ',');
        $avg_lh = number_format(($lasthit == 0 ? 0 : ($lasthit / $counter)), 0, '.', ',');
        $avg_hero_damage = round(($hero_dmg == 0 ? 0 : ($hero_dmg / $counter)), 0);
        $avg_ward = number_format(($warding == 0 ? 0 : ($warding / $cw)), 1, '.', ',');
        $avg_deward = number_format(($deward == 0 ? 0 : ($deward / $cd)), 1, '.', ',');
        $avg_tower_damage = round(($tower_dmg == 0 ? 0 : ($tower_dmg / $counter)), 0);
        $total = $win + $lose;
        $winrate = intval(((round(($win / $total), 2)) * 100));

        $avg_kills = number_format(($k == 0 ? 0 : ($k / $counter)), 0, '.', ',');
        $avg_assists = number_format(($a == 0 ? 0 : ($a / $counter)), 0, '.', ',');
        $avg_death = number_format(($d == 0 ? 0 : ($d / $counter)), 0, '.', ',');

        //dd($avg_kills);

        //coding masuk dalam database data itu
        $knowledge = $this->user->knowledge()->create([
            'mid' => $mid,
            'carry' => $carry,
            'roamer' => $roamer,
            'support' => $support,
            'offlaner' => $offlaner,
            'winrate' => $winrate,
            'gpm' => $avg_gpm,
            'xppm' => $avg_xppm,
            'lasthit' => $avg_lh,
            'hero_dmg' => $avg_hero_damage,
            'tower_dmg' => $avg_tower_damage,
            'ward' => $avg_ward,
            'deward' => $avg_deward,
            'kills' => $avg_kills,
            'assists' => $avg_assists,
            'death' => $avg_death,
            'matches' => $counter,

        ]);
    }
}
