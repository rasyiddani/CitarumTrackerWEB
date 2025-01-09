<?php

namespace Database\Seeders;

use App\Models\User;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class IndexSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'              => 'Admin',
            'email'             => 'admin@mail.com',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'password'          => Hash::make('12345678'),
            'username'          => 'admin',
        ]);

        $startTime = new DateTime('-20 minutes');
        $endTime = new DateTime('now');

        $interval = new DateInterval('PT1M');
        $period = new DatePeriod($startTime, $interval, $endTime);

        $timestamps = [];
        foreach ($period as $time) {
            $timestamps[] = $time->format('Y-m-d H:i:s');
        }

        $timestamps[] = $endTime->format('Y-m-d H:i:s');

        for ($i = 0; $i < count($timestamps); $i++) {
            DB::table('nodes')
                ->insert([
                    'created_at'    => date('Y-m-d H:i:s', strtotime($timestamps[$i])),
                    'node'          => 'Node 1',
                    'fasa'          => rand(1, 10),
                    'imaginer'      => rand(1, 10),
                    'latitude'      => '5.941306',
                    'longitude'     => '106.987722',
                    'magnitude'     => rand(1, 10),
                    'real'          => rand(1, 10),
                    'impedance'     => rand(10000, 10100),
                    'time'          => date('H:i:s', strtotime($timestamps[$i])),
                ]);

            DB::table('nodes')
                ->insert([
                    'created_at'    => date('Y-m-d H:i:s', strtotime($timestamps[$i])),
                    'node'          => 'Node 7',
                    'fasa'          => rand(1, 10),
                    'imaginer'      => rand(1, 10),
                    'latitude'      => '5.941306',
                    'longitude'     => '106.987722',
                    'magnitude'     => rand(1, 10),
                    'real'          => rand(1, 10),
                    'impedance'     => rand(10000, 10100),
                    'time'          => date('H:i:s', strtotime($timestamps[$i])),
                ]);
        }

        DB::table('settings')
            ->insert([
                'created_at'    => date('Y-m-d H:i:s'),
                'value'         => 10050,
                'over'          => 'danger',
                'under'         => 'stable'
            ]);
    }
}
