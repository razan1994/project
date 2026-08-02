<?php

use App\Http\Controllers\Frontend\FrontendController;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Support\Facades\View;

it('renders JSON-LD in the head without HTML escaping', function () {
    View::share('seoJsonLd', '{"@context":"https://schema.org","@type":"WebSite"}');

    $content = view('frontend.layout.partials.head')->render();

    expect($content)->toContain('<script type="application/ld+json">{"@context":"https://schema.org","@type":"WebSite"}</script>');
    expect($content)->not->toContain('&quot;');
});

it('renders apostrophes in meta and OpenGraph descriptions without HTML escaping', function () {
    SEOMeta::setDescription("Jane's project description");
    OpenGraph::setDescription("Jane's project description");

    $content = view('frontend.layout.partials.head')->render();

    expect($content)->toContain("Jane's project description");
    expect($content)->not->toContain('&#039;');
});

it('adds a fallback postal address to the organization schema for rich results', function () {
    $controller = new FrontendController();
    $method = new \ReflectionMethod($controller, 'buildBaseSeoNodes');
    $method->setAccessible(true);

    $nodes = $method->invoke($controller, 'https://example.com/page', 'Page title', 'Page description', 'en', 'Al Jeel Contracting', 'https://example.com', 'https://example.com/logo');

    expect($nodes[2]['address'])->toBe([
        '@type' => 'PostalAddress',
        'addressCountry' => 'SA',
    ]);
});

it('does not emit the unsupported isPartOf property in the shared schema graph', function () {
    $controller = new FrontendController();
    $method = new \ReflectionMethod($controller, 'buildBaseSeoNodes');
    $method->setAccessible(true);

    $nodes = $method->invoke($controller, 'https://example.com/page', 'Page title', 'Page description', 'en', 'Al Jeel Contracting', 'https://example.com', 'https://example.com/logo');

    expect($nodes[0])->not->toHaveKey('isPartOf');
    expect($nodes[1])->not->toHaveKey('isPartOf');
    expect($nodes[2])->not->toHaveKey('isPartOf');
});
