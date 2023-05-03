<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use App\Models\Coin;


class CoingeckoApiCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'coingecko:fetch-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retrieve data from Coingecko API and store it in a database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //  use the GuzzleHttp\Client package to make a GET request to the Coingecko API endpoint and retrieve the response data
        $client = new Client();
        $response = $client->get('https://api.coingecko.com/api/v3/coins/list?include_platform=true');
        $data = json_decode($response->getBody(), true);

        // Insert data into database from the api
        foreach ($data as $coin) {
            Coin::updateOrCreate(
                ['coin_id' => $coin['id']],
                [
                    'symbol' => $coin['symbol'],
                    'name' => $coin['name'],
                    'platforms' => json_encode($coin['platforms']),
                ]
            );
        }

        $this->info('Data fetched from Coingecko API and stored in the database');
    }
}
