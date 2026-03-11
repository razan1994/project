<?php

namespace Database\Seeders;

use App\Models\Mission;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class MissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mission = Mission::first();
        if (!$mission) {
            Mission::create([
                'title_ar' => 'رسالتنا',
                'title_en' => 'Our Mission',
                'description_ar' => 'رسالتنا',
                'description_en' => 'Our Mission',
            ]);
        }
    }
}
