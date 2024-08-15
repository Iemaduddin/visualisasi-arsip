<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'nip' => '1585',
                'nama' => 'Iemaduddin',
                'username' => 'iemaduddin',
                'email' => 'iemaduddin@gmail.com',
                'role_id' => 1,
                'password' => 'password',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'nip' => '1111',
                'nama' => 'Didin',
                'email' => 'didin@gmail.com',
                'username' => 'didin',
                'role_id' => 2,
                'password' => 'password',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
        ];
        foreach ($users as $user) {
            User::create($user);
        }
    }
}
