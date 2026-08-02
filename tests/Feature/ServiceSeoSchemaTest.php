<?php

use App\Models\Service;

it('builds a separate service schema node with Saudi Arabia scope and normalized image URLs', function () {
    Service::create([
        'status' => 1,
        'title_en' => 'Test Service',
        'title_ar' => 'خدمة اختبار',
        'desc_en' => 'A test service description.',
        'desc_ar' => 'وصف خدمة اختبار.',
        'meta_desc_en' => 'Meta description for test service.',
        'meta_desc_ar' => 'وصف ميتا لخدمة اختبار.',
        'alias_name_en' => 'test-service',
        'alias_name_ar' => 'خدمة-اختبار',
        'image' => '/storage/services//test-service.jpg',
    ]);

    app()->setLocale('en');
    $response = $this->get(route('services.details', ['slug' => 'test-service']));

    $response->assertOk();
    $content = $response->content();
    $pageUrl = rtrim(config('app.url', url('/')), '/') . route('services.details', ['slug' => 'test-service'], false);

    expect($content)
        ->toContain('"@type":"WebPage"')
        ->toContain('"@type":"Service"')
        ->toContain('"mainEntity":{"@id":"' . $pageUrl . '#service"}')
        ->toContain('"name":"Saudi Arabia"')
        ->not->toContain('"name":"India"')
        ->not->toContain('/storage/services//')
        ->toContain('Al Jeel Contracting delivers construction and engineering solutions across Saudi Arabia.');
});
