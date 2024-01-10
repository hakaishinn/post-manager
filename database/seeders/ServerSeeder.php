<?php

namespace Database\Seeders;

use App\Models\Server;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class ServerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $response = Http::get('https://genplusmedia.online/manager/servers/json/1.json?api_key=0906429283');
        $servers = collect($response['data'])->map(function($server){
            return [
                'id' => $server['id'],
                'ip_address' => $server['ip_address']
            ];
        });

        try {
            foreach ($servers as $server) {
                Server::create($server);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
