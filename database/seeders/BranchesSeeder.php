<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Region;
use Illuminate\Database\Seeder;

class BranchesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Example: Loop through each region and create sample branches
        $regions = Region::with('country')->get();

        if ($regions->isEmpty()) {
            $this->command->warn('No regions found! Please seed countries and regions first.');
            return;
        }

        $branchesData = [];

        foreach ($regions as $region) {
            $branchesData[] = [
                'name' => $region->name_en.' Main Branch',
                'address' => $region->name_en.' Center, '.$region->country->name_en,
                'phone' => '+966-555-'.rand(100000, 999999),
                'is_active' => true,
                'country_id' => $region->country_id,
                'region_id' => $region->id,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $branchesData[] = [
                'name' => $region->name_en.' Secondary Branch',
                'address' => 'Near downtown area of '.$region->name_en,
                'phone' => '+966-555-'.rand(100000, 999999),
                'is_active' => true,
                'country_id' => $region->country_id,
                'region_id' => $region->id,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Branch::insert($branchesData);

        $this->command->info('Branches seeded successfully: '.count($branchesData));
    }
}
