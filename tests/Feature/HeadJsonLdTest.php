<?php

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
