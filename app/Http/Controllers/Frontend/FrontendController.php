<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\ConsultationRequestEmail;
use App\Mail\ContactUsEmail;
use App\Models\ContactUs;
use App\Models\ContactUsRequest;
use App\Models\SeoPage;
use App\Models\Blog;
use App\Models\ConsultationRequest;
use App\Models\Faq;
use App\Models\Project;
use App\Models\Service;
use App\Models\SupportTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLdMulti;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class FrontendController extends Controller
{
    // -------------------------------------------------------------------------
    // SEO helper
    // -------------------------------------------------------------------------

    private function shareSeoJsonLd(array $nodes): void
    {
        $cleanNodes = $this->removeEmptyValues($nodes);
        $jsonLdGraph = json_encode([
            '@context' => 'https://schema.org',
            '@graph' => array_values(array_filter($cleanNodes, fn ($node) => is_array($node) && !empty($node))),
        ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        View::share('seoJsonLd', $jsonLdGraph);
    }

    private function buildBaseSeoNodes(
        string $pageUrl,
        string $pageName,
        string $description,
        string $locale,
        string $siteName,
        string $appUrl,
        string $pageImageUrl,
        string $pageType = 'WebPage',
        string $pageIdSuffix = '#webpage',
        ?string $organizationLogoUrl = null,
        ?array $organizationExtra = null
    ): array {
        $organizationLogoUrl ??= $pageImageUrl;
        $organizationExtra ??= [];

        $organizationAddress = [
            '@type' => 'PostalAddress',
            'addressCountry' => 'SA',
        ];

        return [
            [
                '@type' => $pageType,
                '@id' => $pageUrl . $pageIdSuffix,
                'url' => $pageUrl,
                'name' => $pageName,
                'description' => $description,
                'inLanguage' => $locale,
                'isPartOf' => ['@id' => $appUrl . '#website'],
                'about' => ['@id' => $appUrl . '#organization'],
                'publisher' => ['@id' => $appUrl . '#organization'],
            ],
            [
                '@type' => 'WebSite',
                '@id' => $appUrl . '#website',
                'url' => $appUrl,
                'name' => $siteName,
                'inLanguage' => $locale,
                'publisher' => ['@id' => $appUrl . '#organization'],
            ],
            [
                '@type' => 'HomeAndConstructionBusiness',
                '@id' => $appUrl . '#organization',
                'name' => $siteName,
                'url' => $appUrl,
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => $organizationLogoUrl,
                ],
                'description' => $description,
                'address' => $organizationAddress,
                ...$organizationExtra,
            ],
        ];
    }

    private function removeEmptyValues(mixed $value): mixed
    {
        if (is_array($value)) {
            $result = [];
            foreach ($value as $key => $item) {
                $cleaned = $this->removeEmptyValues($item);
                if ($cleaned === null || $cleaned === '' || $cleaned === []) {
                    continue;
                }
                $result[$key] = $cleaned;
            }

            return $result;
        }

        if (is_string($value)) {
            $trimmed = trim($value);

            return $trimmed === '' ? null : $trimmed;
        }

        return $value;
    }

    private function toSchemaAssetUrl(string $path, string $baseUrl): string
    {
        if (empty($path)) {
            return $this->normalizeUrl(asset('assets/images/Logo.png'), $baseUrl);
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $this->normalizeUrl($path, $baseUrl);
        }

        $cleanPath = preg_replace('#/+#', '/', '/' . ltrim($path, '/'));

        return $this->normalizeUrl(asset($cleanPath), $baseUrl);
    }

    private function setupSeo(
        ?SeoPage $seo,
        string   $routeName,
        string   $defaultTitle,
        string   $type = 'website',
        ?ContactUs $contact = null
    ): void {
        $locale   = Config::get('app.locale');
        $isArabic = $locale === 'ar';
        $siteName = config('app.name', 'Aljeel Contracting');
        $contact  = $contact ?? ContactUs::query()->first();

        $seoTitle = $seo
            ? ($isArabic ? ($seo->seo_title_ar ?: $siteName) : ($seo->seo_title_en ?: $siteName))
            : $defaultTitle;

        $metaDesc = $seo
            ? ($isArabic ? ($seo->meta_desc_ar ?? '') : ($seo->meta_desc_en ?? ''))
            : '';

        $keywords = $seo
            ? ($isArabic ? ($seo->keywords_ar ?? '') : ($seo->keywords_en ?? ''))
            : '';

        $h1 = $seo
            ? ($isArabic ? ($seo->h1_val_ar ?? '') : ($seo->h1_val_en ?? ''))
            : '';

        $h2 = $seo
            ? ($isArabic ? ($seo->h2_val_ar ?? '') : ($seo->h2_val_en ?? ''))
            : '';

        $baseUrl      = rtrim(config('app.url', url('/')), '/');
        $normalizedBaseUrl = $this->normalizeUrl($baseUrl, $baseUrl);
        $pageUrl      = $this->normalizeUrl(route($routeName), $normalizedBaseUrl);
        $appUrl       = rtrim($normalizedBaseUrl, '/');
        $ogLocale     = $isArabic ? 'ar_SA' : 'en_US';
        $imageUrl     = $this->normalizeUrl(asset('assets/images/Logo.png'), $baseUrl);
        $phone        = trim((string) ($contact?->phone ?? ''));
        $email        = trim((string) ($contact?->email ?? config('mail.from.address')));
        $address      = trim((string) ($contact?->address ?? ''));
        $safeDescription = trim(preg_replace('/\s+/', ' ', strip_tags($metaDesc ?: '')));
        $defaultDescription = 'Al Jeel Contracting delivers construction and engineering solutions across Saudi Arabia.';

        SEOMeta::setTitle($seoTitle);
        SEOMeta::setDescription($metaDesc);
        SEOMeta::setCanonical($pageUrl);
        SEOMeta::setRobots('index, follow');
        if ($keywords) {
            SEOMeta::setKeywords(array_map('trim', explode(',', $keywords)));
        }

        OpenGraph::setTitle($seoTitle);
        OpenGraph::setDescription($metaDesc);
        OpenGraph::setUrl($pageUrl);
        OpenGraph::setSiteName($siteName);
        OpenGraph::addProperty('type', $type);
        OpenGraph::addProperty('locale', $ogLocale);
        OpenGraph::addProperty('locale:alternate', $isArabic ? 'en_US' : 'ar_SA');
        OpenGraph::addImage($imageUrl);
        OpenGraph::addProperty('image:alt', $seoTitle);

        TwitterCard::setType('summary_large_image');
        TwitterCard::setTitle($seoTitle);
        TwitterCard::setDescription($metaDesc);
        TwitterCard::setUrl($pageUrl);
        TwitterCard::setImage($imageUrl);

        $organizationExtra = [];
        if ($address) {
            $organizationExtra['address'] = [
                '@type' => 'PostalAddress',
                'streetAddress' => $address,
                'addressCountry' => 'SA',
            ];
        }
        if ($phone) {
            $organizationExtra['telephone'] = $phone;
        }
        if ($email) {
            $organizationExtra['email'] = $email;
        }

        $graphNodes = $this->buildBaseSeoNodes($pageUrl, $seoTitle, $safeDescription ?: $defaultDescription, $locale, $siteName, $appUrl, $imageUrl, 'WebPage', '#webpage', null, $organizationExtra);
        $graphNodes[2]['description'] = $safeDescription ?: $defaultDescription;

        if ($routeName === 'home') {
            $faqItems = Faq::query()->active()->get();
            $featuredServices = Service::query()->where('status', 1)->latest()->take(6)->get();

            if ($faqItems->isNotEmpty()) {
                $graphNodes[] = [
                    '@type' => 'FAQPage',
                    '@id' => $pageUrl . '#faqpage',
                    'url' => $pageUrl,
                    'name' => $seoTitle,
                    'isPartOf' => ['@id' => $pageUrl . '#webpage'],
                    'mainEntity' => $faqItems->map(fn ($faq) => [
                        '@type' => 'Question',
                        'name' => $faq->question,
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => trim(preg_replace('/\s+/', ' ', strip_tags($faq->answer))),
                        ],
                    ])->values()->toArray(),
                ];
            }

            if ($featuredServices->isNotEmpty()) {
                $serviceOffers = $featuredServices->map(function ($service) use ($appUrl, $locale) {
                    $serviceName = $locale === 'ar' ? ($service->title_ar ?: $service->title_en) : ($service->title_en ?: $service->title_ar);
                    $serviceDescription = $locale === 'ar'
                        ? trim(preg_replace('/\s+/', ' ', strip_tags($service->desc_ar ?? $service->desc_en ?? '')))
                        : trim(preg_replace('/\s+/', ' ', strip_tags($service->desc_en ?? $service->desc_ar ?? '')));

                    return [
                        '@type' => 'Offer',
                        'name' => $serviceName,
                        'description' => $serviceDescription ?: 'Construction and engineering service by Al Jeel Contracting.',
                        'url' => $this->normalizeUrl(route('services.details', $service->alias_name_en ?: $service->id), $appUrl),
                    ];
                })->values()->toArray();

                $graphNodes[2]['hasOfferCatalog'] = [
                    '@type' => 'OfferCatalog',
                    'name' => $locale === 'ar' ? 'خدماتنا' : 'Our Services',
                    'itemListElement' => $serviceOffers,
                ];
            }
        }

        $this->shareSeoJsonLd($graphNodes);

        // Share h1/h2 with the layout view
        View::share('seoH1', $h1);
        View::share('seoH2', $h2);
    }

    private function normalizeUrl(string $url, string $baseUrl): string
    {
        if (empty($url)) {
            return $baseUrl;
        }

        $normalizedBaseUrl = rtrim($baseUrl, '/');

        if (str_starts_with($url, 'http://')) {
            $url = 'https://' . substr($url, 7);
        }

        if (str_starts_with($url, 'https://')) {
            return str_replace('http://', 'https://', $url);
        }

        return $normalizedBaseUrl . '/' . ltrim($url, '/');
    }

    // -------------------------------------------------------------------------
    // Pages
    // -------------------------------------------------------------------------

    public function index(Route $route)
    {
        try {
            $seo     = SeoPage::getCached('home');
            $contact = ContactUs::query()->first();
            $this->setupSeo($seo, 'home', config('app.name', 'Aljeel'));
            return view('frontend.index', compact('contact'));
        } catch (\Throwable $th) {
            return $this->handleError($th, $route);
        }
    }

    public function aboutUs(Route $route)
    {
        try {
            $seo = SeoPage::getCached('about_us');
            $this->setupSeo($seo, 'about-us', __('frontend.navbar_about_us'));

            $locale   = Config::get('app.locale');
            $siteName = config('app.name', 'Aljeel Contracting');
            $baseUrl  = rtrim(config('app.url', url('/')), '/');
            $pageUrl  = $this->normalizeUrl(route('about-us'), $baseUrl);
            $imageUrl = $this->normalizeUrl(asset('assets/images/Logo.png'), $baseUrl);
            $description = trim(preg_replace('/\s+/', ' ', strip_tags($seo?->meta_desc_en ?? $seo?->meta_desc_ar ?? '')));

            $this->shareSeoJsonLd($this->buildBaseSeoNodes($pageUrl, $seo?->seo_title_en ?: __('frontend.navbar_about_us'), $description ?: 'About Al Jeel Contracting and our experience in delivering high-quality construction services.', $locale, $siteName, $baseUrl, $imageUrl, 'AboutPage', '#webpage'));

            return view('frontend.about-us');
        } catch (\Throwable $th) {
            return $this->handleError($th, $route);
        }
    }

    public function services(Route $route)
    {
        try {
            $seo      = SeoPage::getCached('services');
            $contact  = ContactUs::query()->first();
            $svcItems = Service::query()->where('status', 1)->get();
            $this->setupSeo($seo, 'services', __('frontend.navbar_services'));

            $locale      = Config::get('app.locale');
            $isArabic    = $locale === 'ar';
            $siteName    = config('app.name', 'Aljeel Contracting');
            $baseUrl     = rtrim(config('app.url', url('/')), '/');
            $servicesUrl = $this->normalizeUrl(route('services'), $baseUrl);
            $pageUrl     = $servicesUrl;
            $imageUrl    = $this->normalizeUrl(asset('assets/images/Logo.png'), $baseUrl);
            $description = trim(preg_replace('/\s+/', ' ', strip_tags($seo?->meta_desc_en ?? $seo?->meta_desc_ar ?? '')));

            $graphNodes = $this->buildBaseSeoNodes($pageUrl, __('frontend.navbar_services'), $description ?: 'Explore Al Jeel Contracting services and solutions across Saudi Arabia.', $locale, $siteName, $baseUrl, $imageUrl, 'CollectionPage', '#webpage');
            $graphNodes[] = [
                '@type' => 'BreadcrumbList',
                '@id' => $servicesUrl . '#breadcrumbs',
                'itemListElement' => [
                    ['@type' => 'ListItem', 'position' => 1, 'name' => $isArabic ? 'الرئيسية' : 'Home', 'item' => $this->normalizeUrl(route('home'), $baseUrl)],
                    ['@type' => 'ListItem', 'position' => 2, 'name' => __('frontend.navbar_services'), 'item' => $servicesUrl],
                ],
            ];
            $graphNodes[] = [
                '@type' => 'ItemList',
                '@id' => $servicesUrl . '#services-list',
                'itemListElement' => $svcItems->map(fn($s, $i) => [
                    '@type' => 'ListItem',
                    'position' => $i + 1,
                    'name' => $isArabic ? $s->title_ar : $s->title_en,
                    'url' => $this->normalizeUrl(route('services.details', $s->slug ?: $s->id), $baseUrl),
                ])->values()->toArray(),
            ];
            $this->shareSeoJsonLd($graphNodes);

            return view('frontend.services', compact('contact'));
        } catch (\Throwable $th) {
            return $this->handleError($th, $route);
        }
    }

    public function serviceDetails(Route $route, string $slug)
    {
        try {
            $service = Service::query()
                ->where('status', 1)
                ->where(function ($query) use ($slug) {
                    $query->where('alias_name_en', $slug)
                        ->orWhere('alias_name_ar', $slug);
                })
                ->first();

            if (!$service && is_numeric($slug)) {
                $service = Service::query()
                    ->where('status', 1)
                    ->find((int) $slug);
            }

            if (!$service) {
                abort(404);
            }

            $service->loadMissing('media');

            $locale   = Config::get('app.locale');
            $isArabic = $locale === 'ar';
            $siteName = config('app.name', 'Aljeel Contracting');

            $seoTitle = $isArabic
                ? ($service->seo_title_ar ?: $service->title_ar)
                : ($service->seo_title_en ?: $service->title_en);

            $rawDesc  = $isArabic
                ? ($service->meta_desc_ar ?: strip_tags($service->desc_ar ?? ''))
                : ($service->meta_desc_en ?: strip_tags($service->desc_en ?? ''));
            $metaDesc = trim(preg_replace('/\s+/', ' ', $rawDesc));

            $altText  = $isArabic
                ? ($service->alt_text_ar ?: $service->title_ar)
                : ($service->alt_text_en ?: $service->title_en);

            $h1 = $isArabic ? ($service->h1_val_ar ?? '') : ($service->h1_val_en ?? '');
            $h2 = $isArabic ? ($service->h2_val_ar ?? '') : ($service->h2_val_en ?? '');

            $pageUrl     = $this->normalizeUrl(url()->current(), rtrim(url('/'), '/'));
            $ogLocale    = $isArabic ? 'ar_SA' : 'en_US';
            $appUrl      = rtrim(url('/'), '/');
            $imageUrl    = $this->toSchemaAssetUrl($service->image ? $service->image : 'assets/images/Logo.png', $appUrl);
            $brandImageUrl = $this->normalizeUrl(asset('assets/images/Logo.png'), $appUrl);
            $servicesUrl = $this->normalizeUrl(route('services'), $appUrl);

            SEOMeta::setTitle($seoTitle);
            SEOMeta::setDescription($metaDesc);
            SEOMeta::setCanonical($pageUrl);
            SEOMeta::setRobots('index, follow');

            OpenGraph::setTitle($seoTitle);
            OpenGraph::setDescription($metaDesc);
            OpenGraph::setUrl($pageUrl);
            OpenGraph::setSiteName($siteName);
            OpenGraph::addProperty('type', 'website');
            OpenGraph::addProperty('locale', $ogLocale);
            OpenGraph::addProperty('locale:alternate', $isArabic ? 'en_US' : 'ar_SA');
            OpenGraph::addImage($imageUrl);
            OpenGraph::addProperty('image:alt', $altText);

            TwitterCard::setType('summary_large_image');
            TwitterCard::setTitle($seoTitle);
            TwitterCard::setDescription($metaDesc);
            TwitterCard::setUrl($pageUrl);
            TwitterCard::setImage($imageUrl);

            $serviceName = $isArabic ? $service->title_ar : $service->title_en;
            $companyDescription = 'Al Jeel Contracting delivers construction and engineering solutions across Saudi Arabia.';
            $graphNodes = $this->buildBaseSeoNodes($pageUrl, $seoTitle, $metaDesc ?: 'Detailed construction service information from Al Jeel Contracting.', $locale, $siteName, $appUrl, $brandImageUrl, 'WebPage', '#webpage', $brandImageUrl);
            $graphNodes[2]['description'] = $companyDescription;
            $graphNodes[0]['mainEntity'] = ['@id' => $pageUrl . '#service'];
            $graphNodes[0]['mainEntityOfPage'] = ['@id' => $pageUrl . '#webpage'];
            $graphNodes[0]['isPartOf'] = ['@id' => $servicesUrl . '#webpage'];
            $graphNodes[0]['hasPart'] = [['@type' => 'ImageObject', 'url' => $imageUrl, 'name' => $altText]];
            foreach ($service->media->filter(fn($m) => str_starts_with((string) $m->mime_type, 'image/')) as $m) {
                $graphNodes[0]['hasPart'][] = ['@type' => 'ImageObject', 'url' => $this->toSchemaAssetUrl($m->path, $appUrl), 'name' => $serviceName];
            }
            $graphNodes[] = [
                '@type' => 'Service',
                '@id' => $pageUrl . '#service',
                'name' => $serviceName,
                'url' => $pageUrl,
                'description' => $metaDesc ?: 'Detailed construction service information from Al Jeel Contracting.',
                'serviceType' => $serviceName,
                'provider' => ['@id' => $appUrl . '#organization'],
                'areaServed' => [
                    ['@type' => 'Country', 'name' => 'Saudi Arabia'],
                ],
                'offers' => [
                    '@type' => 'Offer',
                    'availability' => 'https://schema.org/InStock',
                ],
                'image' => $imageUrl,
                'hasPart' => [['@type' => 'ImageObject', 'url' => $imageUrl, 'name' => $altText]],
            ];
            $graphNodes[] = [
                '@type' => 'BreadcrumbList',
                '@id' => $pageUrl . '#breadcrumbs',
                'itemListElement' => [
                    ['@type' => 'ListItem', 'position' => 1, 'name' => $isArabic ? 'الرئيسية' : 'Home', 'item' => $this->normalizeUrl(route('home'), $appUrl)],
                    ['@type' => 'ListItem', 'position' => 2, 'name' => __('frontend.navbar_services'), 'item' => $servicesUrl],
                    ['@type' => 'ListItem', 'position' => 3, 'name' => $serviceName, 'item' => $pageUrl],
                ],
            ];
            $this->shareSeoJsonLd($graphNodes);

            View::share('seoH1', $h1);
            View::share('seoH2', $h2);

            // Hreflang with locale-specific slugs
            $enBase = LaravelLocalization::getURLFromRouteNameTranslated('en', 'routes.services');
            $arBase = LaravelLocalization::getURLFromRouteNameTranslated('ar', 'routes.services');
            View::share('hreflang_en', rtrim($enBase, '/') . '/' . ($service->alias_name_en ?: $service->id));
            View::share('hreflang_ar', rtrim($arBase, '/') . '/' . ($service->alias_name_ar ?: $service->id));

            return view('frontend.service-details', compact('service'));
        } catch (\Throwable $th) {
            return $this->handleError($th, $route);
        }
    }

    public function designBuildProject(Route $route)
    {
        try {
            $seo = SeoPage::getCached('design_build_projects');
            $this->setupSeo($seo, 'design-build-project', __('frontend.design-build-project'));
            return view('frontend.design-build-project');
        } catch (\Throwable $th) {
            return $this->handleError($th, $route);
        }
    }

    public function contactUs(Route $route)
    {
        try {
            $seo     = SeoPage::getCached('contact_us');
            $contact = ContactUs::query()->first();
            $this->setupSeo($seo, 'contact-us', __('frontend.navbar_contact'));

            $locale   = Config::get('app.locale');
            $siteName = config('app.name', 'Aljeel Contracting');
            $baseUrl  = rtrim(config('app.url', url('/')), '/');
            $pageUrl  = $this->normalizeUrl(route('contact-us'), $baseUrl);
            $imageUrl = $this->normalizeUrl(asset('assets/images/Logo.png'), $baseUrl);
            $description = trim(preg_replace('/\s+/', ' ', strip_tags($seo?->meta_desc_en ?? $seo?->meta_desc_ar ?? '')));

            $this->shareSeoJsonLd($this->buildBaseSeoNodes($pageUrl, __('frontend.navbar_contact'), $description ?: 'Contact Al Jeel Contracting for construction, engineering, and consultation services in Saudi Arabia.', $locale, $siteName, $baseUrl, $imageUrl, 'ContactPage', '#webpage'));

            return view('frontend.contact-us', compact('contact'));
        } catch (\Throwable $th) {
            return $this->handleError($th, $route);
        }
    }

    public function submitContactUs(Request $request)
    {

        if ($request->filled('website')) {
            return redirect()->back()
                ->withInput([])
                ->with('error', 'Spam detected.');
        }

        $validator = Validator::make($request->all(), [
            'full_name' => ['required', 'string', 'min:2', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->withFragment('contact-section')
                ->with('contact_error', 'Please fix the highlighted fields and try again.');
        }

        $validated = $validator->validated();

        try {
            ContactUsRequest::query()->create($validated);
        } catch (\Throwable $e) {
            Log::error('ContactUsRequest DB error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'data' => $validated
            ]);
            return back()
                ->withFragment('contact-section')
                ->with('contact_error', 'Database error: ' . $e->getMessage());
        }

        try {
            Mail::to(config('mail.from.address'))->send(new ContactUsEmail(
                $validated['full_name'],
                $validated['email'],
                $validated['phone'],
                $validated['subject'],
                $validated['message']
            ));
        } catch (\Throwable $e) {
            Log::error('ContactUsRequest mail error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'data' => $validated
            ]);
            return back()
                ->withFragment('contact-section')
                ->with('contact_error', 'Mail error: ' . $e->getMessage());
        }

        return back()
            ->withFragment('contact-section')
            ->with('contact_success', 'Your message has been sent successfully.');
    }


    public function submitConsultationRequest(Request $request)
    {
        // Honeypot
        if ($request->filled('website')) {
            return response()->json([
                'status' => 'error',
                'message' => 'Spam detected.'
            ], 422);
        }

        $validated = $request->validate([
            'client_name' => 'required|string|max:255',
            'contact_number' => 'required|string|max:255',
            'preferred_time' => 'required|string|max:255',
            'building_type' => 'required|string|max:255',
            'approved_design' => 'required|string|max:255',
            'land_area' => 'required|string|max:255',
            'construction_area' => 'required|string|max:255',
            'attachments.*' => 'nullable|file|max:10240',
        ]);

        if ($request->hasFile('attachments')) {
            $paths = [];

            foreach ($request->file('attachments') as $file) {
                $originalExtension = $file->getClientOriginalExtension();
                $fileName = uniqid() . '_' . time() . '.' . $originalExtension;
                $paths[] = $file->storeAs('consultation_attachments', $fileName, 'public');
            }

            $validated['attachments'] = json_encode($paths);
        } else {
            $validated['attachments'] = null;
        }

        ConsultationRequest::create($validated);

        Mail::to(config('mail.admin_address', config('mail.from.address')))
            ->send(new ConsultationRequestEmail($validated));

        return response()->json([
            'status' => 'success',
            'message' => 'Submitted successfully'
        ]);
    }

    public function blogs(Route $route)
    {
        try {
            $seo     = SeoPage::getCached('blogs');
            $blogs   = Blog::query()->where('status', 1)->orderByDesc('id')->paginate(9);
            $contact = ContactUs::query()->first();
            $this->setupSeo($seo, 'blogs', __('frontend.navbar_blogs'));

            $locale   = Config::get('app.locale');
            $isArabic = $locale === 'ar';
            $siteName = config('app.name', 'Aljeel Contracting');
            $baseUrl  = rtrim(config('app.url', url('/')), '/');
            $blogsUrl = $this->normalizeUrl(route('blogs'), $baseUrl);
            $pageUrl  = $blogsUrl;
            $imageUrl = $this->normalizeUrl(asset('assets/images/Logo.png'), $baseUrl);
            $description = trim(preg_replace('/\s+/', ' ', strip_tags($seo?->meta_desc_en ?? $seo?->meta_desc_ar ?? '')));

            $graphNodes = $this->buildBaseSeoNodes($pageUrl, __('frontend.navbar_blogs'), $description ?: 'Read the latest construction and engineering insights from Al Jeel Contracting.', $locale, $siteName, $baseUrl, $imageUrl, 'Blog', '#webpage');
            $graphNodes[] = [
                '@type' => 'BreadcrumbList',
                '@id' => $blogsUrl . '#breadcrumbs',
                'itemListElement' => [
                    ['@type' => 'ListItem', 'position' => 1, 'name' => $isArabic ? 'الرئيسية' : 'Home', 'item' => $this->normalizeUrl(route('home'), $baseUrl)],
                    ['@type' => 'ListItem', 'position' => 2, 'name' => __('frontend.navbar_blogs'), 'item' => $blogsUrl],
                ],
            ];
            $graphNodes[] = [
                '@type' => 'ItemList',
                '@id' => $blogsUrl . '#blog-list',
                'itemListElement' => $blogs->getCollection()->map(fn($b, $i) => [
                    '@type' => 'ListItem',
                    'position' => $i + 1,
                    'name' => $isArabic ? $b->title_ar : $b->title_en,
                    'url' => $this->normalizeUrl(route('blogs.details', $b->alias_name_en ?: $b->id), $baseUrl),
                ])->values()->toArray(),
            ];
            $this->shareSeoJsonLd($graphNodes);

            return view('frontend.blogs', compact('blogs', 'contact'));
        } catch (\Throwable $th) {
            return $this->handleError($th, $route);
        }
    }

    public function blogDetails(Route $route, string $slug)
    {
        try {
            $blog = Blog::query()
                ->where(function ($query) use ($slug) {
                    $query->where('alias_name_en', $slug)
                        ->orWhere('alias_name_ar', $slug);
                })
                ->first();

            if (!$blog) {
                abort(404);
            }

            $locale   = Config::get('app.locale');
            $isArabic = $locale === 'ar';
            $siteName = config('app.name', 'Aljeel Contracting');

            $seoTitle = $isArabic
                ? ($blog->seo_title_ar ?: $blog->title_ar)
                : ($blog->seo_title_en ?: $blog->title_en);

            $rawDesc  = $isArabic
                ? ($blog->meta_desc_ar ?: strip_tags($blog->desc_ar ?? ''))
                : ($blog->meta_desc_en ?: strip_tags($blog->desc_en ?? ''));
            $metaDesc = trim(preg_replace('/\s+/', ' ', $rawDesc));

            $altText  = $isArabic
                ? ($blog->alt_text_ar ?: $blog->title_ar)
                : ($blog->alt_text_en ?: $blog->title_en);

            $h1 = $isArabic ? ($blog->h1_val_ar ?? '') : ($blog->h1_val_en ?? '');
            $h2 = $isArabic ? ($blog->h2_val_ar ?? '') : ($blog->h2_val_en ?? '');
            $keywords = $isArabic ? ($blog->keywords_ar ?? '') : ($blog->keywords_en ?? '');

            $pageUrl   = $this->normalizeUrl(url()->current(), rtrim(url('/'), '/'));
            $ogLocale  = $isArabic ? 'ar_SA' : 'en_US';
            $appUrl    = rtrim(url('/'), '/');
            $imageUrl  = $this->normalizeUrl($blog->image ? asset(ltrim($blog->image, '/')) : asset('assets/images/Logo.png'), $appUrl);
            $brandImageUrl = $this->normalizeUrl(asset('assets/images/Logo.png'), $appUrl);
            $blogsUrl  = $this->normalizeUrl(route('blogs'), $appUrl);

            SEOMeta::setTitle($seoTitle);
            SEOMeta::setDescription($metaDesc);
            SEOMeta::setCanonical($pageUrl);
            SEOMeta::setRobots('index, follow');

            OpenGraph::setTitle($seoTitle);
            OpenGraph::setDescription($metaDesc);
            OpenGraph::setUrl($pageUrl);
            OpenGraph::setSiteName($siteName);
            OpenGraph::addProperty('type', 'article');
            OpenGraph::addProperty('locale', $ogLocale);
            OpenGraph::addProperty('locale:alternate', $isArabic ? 'en_US' : 'ar_SA');
            OpenGraph::addImage($imageUrl);
            OpenGraph::addProperty('image:alt', $altText);
            OpenGraph::addProperty('article:published_time', $blog->created_at?->toIso8601String());
            OpenGraph::addProperty('article:modified_time', $blog->updated_at?->toIso8601String());

            TwitterCard::setType('summary_large_image');
            TwitterCard::setTitle($seoTitle);
            TwitterCard::setDescription($metaDesc);
            TwitterCard::setUrl($pageUrl);
            TwitterCard::setImage($imageUrl);

            $articleTitle = $isArabic ? $blog->title_ar : $blog->title_en;
            $graphNodes = $this->buildBaseSeoNodes($pageUrl, $seoTitle, $metaDesc ?: 'Read the latest blog post from Al Jeel Contracting.', $locale, $siteName, $appUrl, $brandImageUrl, 'BlogPosting', '#webpage', $brandImageUrl);
            $graphNodes[0]['headline'] = $seoTitle;
            $graphNodes[0]['image'] = $imageUrl;
            $graphNodes[0]['datePublished'] = $blog->created_at?->toIso8601String();
            $graphNodes[0]['dateModified'] = $blog->updated_at?->toIso8601String();
            $graphNodes[0]['author'] = ['@id' => $appUrl . '#organization'];
            $graphNodes[0]['publisher'] = ['@id' => $appUrl . '#organization'];
            $graphNodes[0]['isPartOf'] = ['@id' => $blogsUrl . '#webpage'];
            $graphNodes[0]['mainEntityOfPage'] = ['@id' => $pageUrl . '#webpage'];
            if ($keywords) {
                $graphNodes[0]['keywords'] = array_map('trim', explode(',', $keywords));
            }
            $graphNodes[0]['hasPart'] = [[
                '@type' => 'ImageObject',
                'url' => $imageUrl,
                'name' => $altText,
            ]];
            $graphNodes[] = [
                '@type' => 'BreadcrumbList',
                '@id' => $pageUrl . '#breadcrumbs',
                'itemListElement' => [
                    ['@type' => 'ListItem', 'position' => 1, 'name' => $isArabic ? 'الرئيسية' : 'Home', 'item' => $this->normalizeUrl(route('home'), $appUrl)],
                    ['@type' => 'ListItem', 'position' => 2, 'name' => __('frontend.navbar_blogs'), 'item' => $blogsUrl],
                    ['@type' => 'ListItem', 'position' => 3, 'name' => $articleTitle, 'item' => $pageUrl],
                ],
            ];
            $this->shareSeoJsonLd($graphNodes);

            View::share('seoH1', $h1);
            View::share('seoH2', $h2);

            // Hreflang with locale-specific slugs
            $enBase = LaravelLocalization::getURLFromRouteNameTranslated('en', 'routes.blogs');
            $arBase = LaravelLocalization::getURLFromRouteNameTranslated('ar', 'routes.blogs');
            View::share('hreflang_en', rtrim($enBase, '/') . '/' . ($blog->alias_name_en ?: $blog->id));
            View::share('hreflang_ar', rtrim($arBase, '/') . '/' . ($blog->alias_name_ar ?: $blog->id));

            return view('frontend.blog-details', compact('blog'));
        } catch (\Throwable $th) {
            return $this->handleError($th, $route);
        }
    }

    public function faqs(Route $route)
    {
        try {
            $seo     = SeoPage::getCached('faqs');
            $contact = ContactUs::query()->first();
            $this->setupSeo($seo, 'faqs', __('frontend.faqs_title'));

            $locale   = Config::get('app.locale');
            $siteName = config('app.name', 'Aljeel Contracting');
            $baseUrl  = rtrim(config('app.url', url('/')), '/');
            $pageUrl  = $this->normalizeUrl(route('faqs'), $baseUrl);
            $imageUrl = $this->normalizeUrl(asset('assets/images/Logo.png'), $baseUrl);
            $description = trim(preg_replace('/\s+/', ' ', strip_tags($seo?->meta_desc_en ?? $seo?->meta_desc_ar ?? '')));
            $faqItems = Faq::query()->active()->get();

            $graphNodes = $this->buildBaseSeoNodes($pageUrl, __('frontend.faqs_title'), $description ?: 'Frequently asked questions about Al Jeel Contracting services and project delivery.', $locale, $siteName, $baseUrl, $imageUrl, 'FAQPage', '#webpage');
            if ($faqItems->isNotEmpty()) {
                $graphNodes[0]['mainEntity'] = $faqItems->map(fn ($faq) => [
                    '@type' => 'Question',
                    'name' => $faq->question,
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => trim(preg_replace('/\s+/', ' ', strip_tags($faq->answer))),
                    ],
                ])->values()->toArray();
            }
            $this->shareSeoJsonLd($graphNodes);

            return view('frontend.faqs', compact('contact'));
        } catch (\Throwable $th) {
            return $this->handleError($th, $route);
        }
    }

    public function termsAndConditions(Route $route)
    {
        try {
            $seo = SeoPage::getCached('terms_and_conditions');
            $this->setupSeo($seo, 'terms-and-conditions', __('frontend.terms_title'));

            $locale   = Config::get('app.locale');
            $siteName = config('app.name', 'Aljeel Contracting');
            $baseUrl  = rtrim(config('app.url', url('/')), '/');
            $pageUrl  = $this->normalizeUrl(route('terms-and-conditions'), $baseUrl);
            $imageUrl = $this->normalizeUrl(asset('assets/images/Logo.png'), $baseUrl);
            $description = trim(preg_replace('/\s+/', ' ', strip_tags($seo?->meta_desc_en ?? $seo?->meta_desc_ar ?? '')));
            $this->shareSeoJsonLd($this->buildBaseSeoNodes($pageUrl, __('frontend.terms_title'), $description ?: 'Read the terms and conditions for Al Jeel Contracting services.', $locale, $siteName, $baseUrl, $imageUrl, 'WebPage', '#webpage'));

            return view('frontend.terms-and-conditions');
        } catch (\Throwable $th) {
            return $this->handleError($th, $route);
        }
    }

    public function privacyPolicy(Route $route)
    {
        try {
            $seo = SeoPage::getCached('privacy_policy');
            $this->setupSeo($seo, 'privacy-policy', __('frontend.privacy_title'));

            $locale   = Config::get('app.locale');
            $siteName = config('app.name', 'Aljeel Contracting');
            $baseUrl  = rtrim(config('app.url', url('/')), '/');
            $pageUrl  = $this->normalizeUrl(route('privacy-policy'), $baseUrl);
            $imageUrl = $this->normalizeUrl(asset('assets/images/Logo.png'), $baseUrl);
            $description = trim(preg_replace('/\s+/', ' ', strip_tags($seo?->meta_desc_en ?? $seo?->meta_desc_ar ?? '')));
            $this->shareSeoJsonLd($this->buildBaseSeoNodes($pageUrl, __('frontend.privacy_title'), $description ?: 'Review the privacy policy for Al Jeel Contracting.', $locale, $siteName, $baseUrl, $imageUrl, 'WebPage', '#webpage'));

            return view('frontend.privacy-policy');
        } catch (\Throwable $th) {
            return $this->handleError($th, $route);
        }
    }

    public function gallery(Route $route)
    {
        try {
            $seo     = SeoPage::getCached('gallery');
            $gallery = \App\Models\Gallery::with('images')->first();
            $images  = $gallery ? $gallery->images()->latest()->get() : collect();
            $this->setupSeo($seo, 'gallery', __('frontend.gallery_title'));

            $locale   = Config::get('app.locale');
            $siteName = config('app.name', 'Aljeel Contracting');
            $baseUrl  = rtrim(config('app.url', url('/')), '/');
            $pageUrl  = $this->normalizeUrl(route('gallery'), $baseUrl);
            $imageUrl = $this->normalizeUrl(asset('assets/images/Logo.png'), $baseUrl);
            $description = trim(preg_replace('/\s+/', ' ', strip_tags($seo?->meta_desc_en ?? $seo?->meta_desc_ar ?? '')));
            $this->shareSeoJsonLd($this->buildBaseSeoNodes($pageUrl, __('frontend.gallery_title'), $description ?: 'View project and construction gallery content from Al Jeel Contracting.', $locale, $siteName, $baseUrl, $imageUrl, 'CollectionPage', '#webpage'));

            return view('frontend.gallery', compact('images'));
        } catch (\Throwable $th) {
            return $this->handleError($th, $route);
        }
    }

    public function projects(Route $route)
    {
        try {
            $seo     = SeoPage::getCached('projects');
            $contact = ContactUs::query()->first();
            $this->setupSeo($seo, 'projects', __('frontend.navbar_projects'));

            $locale   = Config::get('app.locale');
            $isArabic = $locale === 'ar';
            $siteName = config('app.name', 'Aljeel Contracting');
            $baseUrl  = rtrim(config('app.url', url('/')), '/');
            $projectsUrl = $this->normalizeUrl(route('projects'), $baseUrl);
            $pageUrl  = $projectsUrl;
            $imageUrl = $this->normalizeUrl(asset('assets/images/Logo.png'), $baseUrl);
            $description = trim(preg_replace('/\s+/', ' ', strip_tags($seo?->meta_desc_en ?? $seo?->meta_desc_ar ?? '')));
            $projects = Project::query()->where('status', 1)->orderByDesc('id')->get();

            $graphNodes = $this->buildBaseSeoNodes($pageUrl, __('frontend.navbar_projects'), $description ?: 'Browse completed residential, commercial, and industrial projects by Al Jeel Contracting.', $locale, $siteName, $baseUrl, $imageUrl, 'CollectionPage', '#webpage');
            $graphNodes[2]['description'] = 'Al Jeel Contracting delivers construction and engineering solutions across Saudi Arabia.';
            $graphNodes[0]['mainEntity'] = ['@id' => $projectsUrl . '#project-list'];
            $graphNodes[] = [
                '@type' => 'ItemList',
                '@id' => $projectsUrl . '#project-list',
                'itemListElement' => $projects->map(fn ($project, $index) => [
                    '@type' => 'ListItem',
                    'position' => $index + 1,
                    'name' => $isArabic ? ($project->title_ar ?: $project->title_en) : ($project->title_en ?: $project->title_ar),
                    'url' => $this->normalizeUrl(route('projects.details', $project->alias_name_en ?: $project->id), $baseUrl),
                ])->values()->toArray(),
            ];
            $graphNodes[] = [
                '@type' => 'BreadcrumbList',
                '@id' => $projectsUrl . '#breadcrumbs',
                'itemListElement' => [
                    ['@type' => 'ListItem', 'position' => 1, 'name' => $isArabic ? 'الرئيسية' : 'Home', 'item' => $this->normalizeUrl(route('home'), $baseUrl)],
                    ['@type' => 'ListItem', 'position' => 2, 'name' => __('frontend.navbar_projects'), 'item' => $projectsUrl],
                ],
            ];
            $this->shareSeoJsonLd($graphNodes);

            return view('frontend.projects', compact('contact'));
        } catch (\Throwable $th) {
            return $this->handleError($th, $route);
        }
    }

    public function projectDetails(Route $route, string $slug)
    {
        try {
            $project = Project::query()
                ->where('status', 1)
                ->where(function ($query) use ($slug) {
                    $query->where('alias_name_en', $slug)
                        ->orWhere('alias_name_ar', $slug);
                })
                ->first();

            if (!$project && is_numeric($slug)) {
                $project = Project::query()
                    ->where('status', 1)
                    ->find((int) $slug);
            }

            if (!$project) {
                abort(404);
            }

            $project->loadMissing('media');

            $locale   = Config::get('app.locale');
            $isArabic = $locale === 'ar';
            $siteName = config('app.name', 'Aljeel Contracting');

            $seoTitle = $isArabic
                ? ($project->seo_title_ar ?: $project->title_ar)
                : ($project->seo_title_en ?: $project->title_en);

            $rawDesc  = $isArabic
                ? ($project->meta_desc_ar ?: strip_tags($project->desc_ar ?? ''))
                : ($project->meta_desc_en ?: strip_tags($project->desc_en ?? ''));
            $metaDesc = trim(preg_replace('/\s+/', ' ', $rawDesc));

            $altText  = $isArabic
                ? ($project->alt_text_ar ?: $project->title_ar)
                : ($project->alt_text_en ?: $project->title_en);

            $h1 = $isArabic ? ($project->h1_val_ar ?? '') : ($project->h1_val_en ?? '');
            $h2 = $isArabic ? ($project->h2_val_ar ?? '') : ($project->h2_val_en ?? '');

            $pageUrl     = $this->normalizeUrl(url()->current(), rtrim(config('app.url', url('/')), '/'));
            $ogLocale    = $isArabic ? 'ar_SA' : 'en_US';
            $baseUrl     = rtrim(config('app.url', url('/')), '/');
            $appUrl      = $this->normalizeUrl('', $baseUrl);
            $projectImagePath = $project->image ? preg_replace('#/+#', '/', ltrim($project->image, '/')) : 'assets/images/Logo.png';
            $imageUrl    = $this->normalizeUrl($project->image ? asset($projectImagePath) : asset('assets/images/Logo.png'), $appUrl);
            $brandImageUrl = $this->normalizeUrl(asset('assets/images/Logo.png'), $appUrl);
            $projectsUrl = $this->normalizeUrl(route('projects'), $appUrl);

            SEOMeta::setTitle($seoTitle);
            SEOMeta::setDescription($metaDesc);
            SEOMeta::setCanonical($pageUrl);
            SEOMeta::setRobots('index, follow');

            OpenGraph::setTitle($seoTitle);
            OpenGraph::setDescription($metaDesc);
            OpenGraph::setUrl($pageUrl);
            OpenGraph::setSiteName($siteName);
            OpenGraph::addProperty('type', 'website');
            OpenGraph::addProperty('locale', $ogLocale);
            OpenGraph::addProperty('locale:alternate', $isArabic ? 'en_US' : 'ar_SA');
            OpenGraph::addImage($imageUrl);
            OpenGraph::addProperty('image:alt', $altText);

            TwitterCard::setType('summary_large_image');
            TwitterCard::setTitle($seoTitle);
            TwitterCard::setDescription($metaDesc);
            TwitterCard::setUrl($pageUrl);
            TwitterCard::setImage($imageUrl);

            $projectName = $isArabic ? $project->title_ar : $project->title_en;
            $companyDescription = 'Al Jeel Contracting delivers construction and engineering solutions across Saudi Arabia.';
            $graphNodes = $this->buildBaseSeoNodes($pageUrl, $seoTitle, $metaDesc ?: 'View a featured Al Jeel Contracting project profile.', $locale, $siteName, $appUrl, $brandImageUrl, 'WebPage', '#webpage', $brandImageUrl);
            $graphNodes[2]['description'] = $companyDescription;
            $graphNodes[0]['name'] = $projectName;
            $graphNodes[0]['image'] = $imageUrl;
            $graphNodes[0]['about'] = ['@id' => $appUrl . '#organization'];
            $graphNodes[0]['isPartOf'] = ['@id' => $projectsUrl . '#webpage'];
            $graphNodes[0]['mainEntity'] = ['@id' => $pageUrl . '#project'];
            $graphNodes[0]['hasPart'] = [['@type' => 'ImageObject', 'url' => $imageUrl, 'name' => $altText]];
            foreach ($project->media->filter(fn($m) => str_starts_with((string) $m->mime_type, 'image/')) as $m) {
                $mediaPath = preg_replace('#/+#', '/', ltrim($m->path, '/'));
                $graphNodes[0]['hasPart'][] = ['@type' => 'ImageObject', 'url' => $this->normalizeUrl(asset($mediaPath), $appUrl), 'name' => $projectName];
            }
            $graphNodes[] = [
                '@type' => 'Project',
                '@id' => $pageUrl . '#project',
                'name' => $projectName,
                'url' => $pageUrl,
                'description' => $metaDesc ?: 'View a featured Al Jeel Contracting project profile.',
                'image' => $imageUrl,
                'location' => [
                    '@type' => 'Place',
                    'address' => [
                        '@type' => 'PostalAddress',
                        'addressCountry' => 'SA',
                    ],
                ],
                'isPartOf' => ['@id' => $projectsUrl . '#webpage'],
            ];
            $graphNodes[] = [
                '@type' => 'BreadcrumbList',
                '@id' => $pageUrl . '#breadcrumbs',
                'itemListElement' => [
                    ['@type' => 'ListItem', 'position' => 1, 'name' => $isArabic ? 'الرئيسية' : 'Home', 'item' => $this->normalizeUrl(route('home'), $appUrl)],
                    ['@type' => 'ListItem', 'position' => 2, 'name' => __('frontend.navbar_projects'), 'item' => $projectsUrl],
                    ['@type' => 'ListItem', 'position' => 3, 'name' => $projectName, 'item' => $pageUrl],
                ],
            ];
            $this->shareSeoJsonLd($graphNodes);

            View::share('seoH1', $h1);
            View::share('seoH2', $h2);

            // Hreflang with locale-specific slugs
            $enBase = LaravelLocalization::getURLFromRouteNameTranslated('en', 'routes.projects');
            $arBase = LaravelLocalization::getURLFromRouteNameTranslated('ar', 'routes.projects');
            View::share('hreflang_en', rtrim($enBase, '/') . '/' . ($project->alias_name_en ?: $project->id));
            View::share('hreflang_ar', rtrim($arBase, '/') . '/' . ($project->alias_name_ar ?: $project->id));

            return view('frontend.project-details', compact('project'));
        } catch (\Throwable $th) {
            return $this->handleError($th, $route);
        }
    }

    // -------------------------------------------------------------------------
    // Error handler
    // -------------------------------------------------------------------------

    private function handleError(\Throwable $th, Route $route): \Illuminate\View\View
    {
        $function_name    = $route->getActionName();
        $check_old_errors = SupportTicket::select('*')->where([
            'error_location'    => $th->getFile(),
            'error_description' => $th->getMessage(),
            'function_name'     => $function_name,
            'error_line'        => $th->getLine(),
        ])->get();

        if ($check_old_errors->count() === 0) {
            $end_error_ticket = SupportTicket::create([
                'error_location'    => $th->getFile(),
                'error_description' => $th->getMessage(),
                'function_name'     => $function_name,
                'error_line'        => $th->getLine(),
            ]);
        } else {
            $end_error_ticket = $check_old_errors->first();
        }

        return view('errors.support_tickets', compact('th', 'function_name', 'end_error_ticket'));
    }
}
