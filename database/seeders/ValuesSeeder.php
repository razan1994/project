<?php

namespace Database\Seeders;

use App\Models\Values;
use App\Models\Vision;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ValuesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = Values::first();
        if (!$values) {
            Values::create([
                'title_ar' => "Writing Title ar in Arabic ",
                'title_en' => "Writing Title en in English ",
                'description_ar' => "Writing our Description in Arabic ",
                'description_en' => "Writing our Description in English ",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
    }
}
