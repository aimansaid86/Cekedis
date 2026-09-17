<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $sellers = [
            'Aiman', 'Nurul', 'Farid', 'Aina', 'Haziq', 'Sofea',
            'Ridzuan', 'Mei Ling', 'Faizal', 'Zulkifli', 'Iman', 'Danial',
        ];

        foreach ($sellers as $i => $name) {
            User::updateOrCreate(
                ['email' => Str::slug($name).'@cekedis.my'],
                [
                    'name' => $name,
                    'phone' => '601'.str_pad((string) (12345670 + $i), 8, '0', STR_PAD_LEFT),
                    'password' => Hash::make('password'),
                    'email_verified_at' => now(),
                ],
            );
        }
    }
}
