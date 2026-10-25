<?php

test('the landing page builds a company name from the requested domain', function (string $url, string $expectedName) {
    $this->get($url)
        ->assertOk()
        ->assertViewIs('landing')
        ->assertViewHas('siteName', $expectedName)
        ->assertSee('Estamos em construção.')
        ->assertSee('Volte em breve.');
})->with([
    'simple domain' => ['http://acme.com/', 'Acme'],
    'www prefix and hyphens' => ['http://www.acme-solucoes.com.br/', 'Acme Solucoes'],
    'subdomain' => ['http://loja.nova-era.net/', 'Nova Era'],
    'country second-level suffix' => ['http://blue_ocean.co.uk/', 'Blue Ocean'],
    'country code only' => ['http://minhaempresa.io/', 'Minhaempresa'],
    'single label host' => ['http://localhost/', 'Localhost'],
]);

test('the landing page falls back to the app name when accessed by ip address', function () {
    config(['app.name' => 'Domain Dock']);

    $this->get('http://127.0.0.1/')
        ->assertOk()
        ->assertViewHas('siteName', 'Domain Dock');
});

test('the landing page can be cached by the edge network', function () {
    $response = $this->get('http://acme.com/');

    $response->assertOk()->assertHeaderMissing('Set-Cookie');

    expect($response->headers->get('Cache-Control'))
        ->toContain('public')
        ->toContain('s-maxage=86400');
});

test('unknown paths return a not found page the edge network can cache', function () {
    $response = $this->get('http://acme.com/.env.production');

    $response->assertNotFound()->assertHeaderMissing('Set-Cookie');

    expect($response->headers->get('Cache-Control'))
        ->toContain('public')
        ->toContain('s-maxage=3600');
});
