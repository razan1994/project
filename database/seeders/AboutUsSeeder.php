<?php

namespace Database\Seeders;

use App\Models\About;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AboutUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $aboutUs = About::first();
        if (!$aboutUs) {
            About::create([
                'title_ar' => "عن الشركة",
                'title_en' => "Writing Title en in English ",
                'description_ar' => "وصف عن الشركة",
                'description_en' => "Writing our Description in English ",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
    }
}
