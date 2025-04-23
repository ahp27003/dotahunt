<?php

namespace App\Jobs;

use App\Statistic;
use App\User;
use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class processMatches implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user, $stats;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, Statistic $stats)
    {
        $this->stats = $stats;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $client = new Client(['base_uri'
        => 'https://api.opendota.com/api/']);

        foreach ($this->stats->recent_match as $recent)
        {


            $match_id = $recent['match_id'];
            //coding for opendota api

            $response = $client->get("matches/$match_id");
            $fetchM = json_decode($response->getBody(), true);

            $this->user->matches()->create([
                'match_id' => $match_id,
                'match_details' => $fetchM,
            ]);

        }

        generatePlayerRole::dispatch($this->user);

    }
}
