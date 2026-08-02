<?php

use App\Http\Controllers\Frontend\FrontendController;

it('uses the brand logo for the organization node in blog schema', function () {
    $controller = new FrontendController();
    $method = new ReflectionMethod($controller, 'buildBaseSeoNodes');
    $method->setAccessible(true);

    $nodes = $method->invoke(
        $controller,
        'https://jeel.test/en/blogs/blog-title',
        'Blog title',
        'Blog description',
        'en',
        'Al Jeel Contracting',
        'https://jeel.test',
        'https://jeel.test/en/blogs/blog-title',
        'BlogPosting',
        '#webpage',
        'https://jeel.test/assets/images/Logo.png'
    );

    $organizationNode = collect($nodes)->firstWhere('@type', 'HomeAndConstructionBusiness');

    expect($organizationNode)->not->toBeNull();
    expect($organizationNode['logo']['url'] ?? null)->toBe('https://jeel.test/assets/images/Logo.png');
});
