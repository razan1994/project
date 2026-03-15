<?php

namespace Database\Seeders;

use App\Models\SeoPage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeoPagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seoPages = [
            [
                'name' => 'home'
            ],
            [
                'name' => 'about_us',
            ],
            [
                'name' => 'faq'
            ],
            [
                'name' => 'contact_us'
            ],
            [
                'name' => 'privacy_policy'
            ],
            [
                'name' => 'terms_and_conditions'
            ],
            [
                'name' => 'services'
            ],
            [
                'name' => 'blogs'
            ],
            [
                'name' => 'design_build_projects'
            ],
        ];

        foreach ($seoPages as $seoPage) {
            if (!SeoPage::where('name', $seoPage['name'])->exists()) {
                SeoPage::create($seoPage);
            }
        }
    }
}
