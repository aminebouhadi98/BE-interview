<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for($i = 0; $i < 20; $i++){
            Company::create([
                'name' => $faker->company,
                'email' => $faker->companyEmail,
                'logo' => 'logos/fake_logo.png',
                'website' => $faker->url,
            ]);
        }
    }
}
