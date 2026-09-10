<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class LandingPageController extends Controller
{
    /**
     * Second-level labels that, combined with a country code, form a public suffix (e.g. "com.br", "co.uk").
     *
     * @var list<string>
     */
    private const array SECOND_LEVEL_LABELS = ['com', 'net', 'org', 'gov', 'edu', 'co', 'ac', 'art', 'blog', 'eco', 'ind', 'inf', 'tec', 'dev', 'app'];

    /**
     * Display the "under construction" landing page for whichever domain was requested.
     */
    public function __invoke(Request $request): View
    {
        $domain = Str::after($request->getHost(), 'www.');

        return view('landing', [
            'siteName' => $this->siteNameFromDomain($domain),
            'domain' => $domain,
        ]);
    }

    /**
     * Build a company-like name from a domain, e.g. "acme-solucoes.com.br" becomes "Acme Solucoes".
     */
    private function siteNameFromDomain(string $domain): string
    {
        if ($domain === '' || filter_var($domain, FILTER_VALIDATE_IP)) {
            return config('app.name');
        }

        $labels = explode('.', $domain);

        if (count($labels) >= 3 && strlen(end($labels)) === 2 && in_array($labels[count($labels) - 2], self::SECOND_LEVEL_LABELS, true)) {
            array_splice($labels, -2);
        } elseif (count($labels) >= 2) {
            array_pop($labels);
        }

        $name = end($labels);

        if (str_starts_with($name, 'xn--') && function_exists('idn_to_utf8')) {
            $name = idn_to_utf8($name) ?: $name;
        }

        return Str::of($name)->replace(['-', '_'], ' ')->squish()->title()->toString();
    }
}
