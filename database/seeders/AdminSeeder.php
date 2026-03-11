<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $admin = User::where('name', 'Admin')->first();
        if (! $admin) {
            User::create([
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('123456789'),
            ]);
        }

        $seoAdmin = User::where('email', 'seo-admin@smartzone.com')->first();
        if (! $seoAdmin) {
            User::create([
                'name' => 'SEO Admin',
                'email' => 'seo-admin@smartzone.com',
                'password' => bcrypt('123456789smartzone'),
            ]);
        }
    }
}
