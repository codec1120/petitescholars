<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

use App\Models\{User, Role};

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->users()->each(fn ($user) => User::create($user));
    }

    private function users(): Collection
    {
        return collect([
            [
                'first_name' => 'Clayvi',
                'last_name' => 'Brown',
                'email' => 'clayvi.brown@petitescholars.org',
                'password' => 'petite01',
                'email_verified_at' => now(),
                'role' => Role::ADMIN
            ],
            [
                'first_name' => 'Allen',
                'last_name' => 'Aguilar',
                'email' => 'allenaguilar@leadershipbuild.com',
                'password' => 'payaso13',
                'email_verified_at' => now(),
                'role' => Role::ADMIN
            ],
            [
                'first_name' => 'Jantinn',
                'last_name' => 'Erezo',
                'email' => 'jantinnerezo@leadershipbuild.com',
                'password' => '@Null2020@',
                'email_verified_at' => now(),
                'role' => Role::ADMIN
            ],
            [
                'first_name' => 'Stephen Luck',
                'last_name' => 'Enguio',
                'email' => 'stephenenguio1120@gmail.com',
                'password' => 'jersey11',
                'email_verified_at' => now(),
                'role' => Role::ADMIN
            ]
        ]);
    }
}
