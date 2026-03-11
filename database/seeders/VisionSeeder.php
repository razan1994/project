<?php

namespace Database\Seeders;

use App\Models\Vision;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class VisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vision = Vision::first();
        if (!$vision) {
            Vision::create([
                'title_ar' => "Writing Title ar in Arabic ",
                'title_en' => "Writing Title en in English ",
                'description_ar' => "Writing our Description in Arabic ",
                'description_en' => "Writing our Description in English ",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
    }
}
