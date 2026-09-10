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
