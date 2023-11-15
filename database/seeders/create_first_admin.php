<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class create_first_admin extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        if (User::all()->count() == 0) {
            $user = User::create([
                'email' => 'admin@mail.com',
                'password' => Hash::make(12341234),
            ]);

            event(new Registered($user));
        }
    }
}
