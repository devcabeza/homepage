<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class AdminUserSeeder extends Seeder
{
    /**
     * Seed the official administrator account for Alejandro Cabeza.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'alejandrocabezaoficial@gmail.com'],
            [
                'name' => 'Alejandro Cabeza',
                'email_verified_at' => Carbon::now(),
            ]
        );
    }
}
