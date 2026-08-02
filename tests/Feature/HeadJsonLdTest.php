<?php

use Illuminate\Support\Facades\View;

it('renders JSON-LD in the head without HTML escaping', function () {
    View::share('seoJsonLd', '{"@context":"https://schema.org","@type":"WebSite"}');

    $content = view('frontend.layout.partials.head')->render();

    expect($content)->toContain('<script type="application/ld+json>{"@context":"https://schema.org","@type":"WebSite"}</script>');
    expect($content)->not->toContain('&quot;');
});
