<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 100; $i++){
            $name = $faker->name();
            $message = $faker->sentence(20);
            $email = $faker->email();
            $phone_number = $faker->e164PhoneNumber();

            $created_at = $faker->dateTimeBetween('-2 years, now');

            DB::table('guests')->insert([
                'name' => $name,
                'message' => $message,
                'email' => $email,
                'phone_number' => $phone_number,
                'created_at' => $created_at,
            ]);
        }

        $tags= [
            ['name' => 'state', 'created_at' => now()],
            ['name' => 'honorable', 'created_at' => now()],
            ['name' => 'uninvinted', 'created_at' => now()],
            ['name' => 'family', 'created_at' => now()],
            ['name' => 'friends', 'created_at' => now()],
        ];

        DB::table('tags')->insert($tags);
    }
}
