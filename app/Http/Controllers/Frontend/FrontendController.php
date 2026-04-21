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

class FrontendController extends Controller
{
    // -------------------------------------------------------------------------
    // SEO helper
    // -------------------------------------------------------------------------

    private function setupSeo(
        ?SeoPage $seo,
        string   $routeName,
        string   $defaultTitle,
        string   $type = 'website'
    ): void {
        $locale   = Config::get('app.locale');
        $isArabic = $locale === 'ar';
        $siteName = config('app.name', 'Aljeel Contracting');

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

        $pageUrl   = route($routeName);
        $ogLocale  = $isArabic ? 'ar_SA' : 'en_US';
        $imageUrl  = asset('assets/images/Logo.png');

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

        JsonLdMulti::setTitle($seoTitle);
        JsonLdMulti::setDescription($metaDesc);
        JsonLdMulti::setType('WebPage');
        JsonLdMulti::setUrl($pageUrl);
        JsonLdMulti::addValue('inLanguage', $locale);

        // Share h1/h2 with the layout view
        View::share('seoH1', $h1);
        View::share('seoH2', $h2);
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
            $svcItems = Service::query()->where('status', 1)->orderBy('order')->get();
            $this->setupSeo($seo, 'services', __('frontend.navbar_services'));

            $locale      = Config::get('app.locale');
            $isArabic    = $locale === 'ar';
            $servicesUrl = route('services');

            // Upgrade listing page schema to CollectionPage
            JsonLdMulti::setType('CollectionPage');

            // Breadcrumb schema
            JsonLdMulti::newJsonLd();
            JsonLdMulti::setType('BreadcrumbList');
            JsonLdMulti::addValue('itemListElement', [
                ['@type' => 'ListItem', 'position' => 1, 'name' => $isArabic ? 'الرئيسية' : 'Home', 'item' => route('home')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => __('frontend.navbar_services'), 'item' => $servicesUrl],
            ]);

            // ItemList of all services for rich results
            JsonLdMulti::newJsonLd();
            JsonLdMulti::setType('ItemList');
            JsonLdMulti::addValue('itemListElement', $svcItems->map(fn($s, $i) => [
                '@type'    => 'ListItem',
                'position' => $i + 1,
                'name'     => $isArabic ? $s->title_ar : $s->title_en,
                'url'      => route('services.details', $s->slug ?: $s->id),
            ])->values()->toArray());

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

            $pageUrl     = url()->current();
            $ogLocale    = $isArabic ? 'ar_SA' : 'en_US';
            $appUrl      = rtrim(preg_replace('/^http:\/\//', 'https://', config('app.url')), '/');
            $imageUrl    = $service->image ? asset(ltrim($service->image, '/')) : asset('assets/images/Logo.png');
            $servicesUrl = route('services');

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
            JsonLdMulti::setTitle($serviceName);
            JsonLdMulti::setDescription($metaDesc);
            JsonLdMulti::setType('Service');
            JsonLdMulti::setUrl($pageUrl);
            JsonLdMulti::addValue('inLanguage', $locale);
            JsonLdMulti::addValue('provider', [
                '@type' => 'Organization',
                'name'  => $siteName,
                'url'   => $appUrl,
            ]);
            JsonLdMulti::addValue('areaServed', [
                ['@type' => 'Country', 'name' => 'Saudi Arabia'],
                ['@type' => 'Country', 'name' => 'India'],
            ]);
            JsonLdMulti::addValue('isPartOf', [
                '@type' => 'WebPage',
                '@id'   => $servicesUrl,
                'name'  => __('frontend.navbar_services'),
                'url'   => $servicesUrl,
            ]);
            JsonLdMulti::addValue('serviceType', $serviceName);
            JsonLdMulti::addValue('offers', [
                '@type'        => 'Offer',
                'availability' => 'https://schema.org/InStock',
                'areaServed'   => [
                    ['@type' => 'Country', 'name' => 'Saudi Arabia'],
                    ['@type' => 'Country', 'name' => 'India'],
                ],
            ]);

            $hasParts = [['@type' => 'ImageObject', 'url' => $imageUrl, 'name' => $altText]];
            foreach ($service->media->filter(fn($m) => str_starts_with((string) $m->mime_type, 'image/')) as $m) {
                $hasParts[] = ['@type' => 'ImageObject', 'url' => asset(ltrim($m->path, '/')), 'name' => $serviceName];
            }
            JsonLdMulti::addValue('hasPart', $hasParts);

            // Breadcrumb schema
            JsonLdMulti::newJsonLd();
            JsonLdMulti::setType('BreadcrumbList');
            JsonLdMulti::addValue('itemListElement', [
                ['@type' => 'ListItem', 'position' => 1, 'name' => $isArabic ? 'الرئيسية' : 'Home', 'item' => route('home')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => __('frontend.navbar_services'), 'item' => $servicesUrl],
                ['@type' => 'ListItem', 'position' => 3, 'name' => $serviceName, 'item' => $pageUrl],
            ]);

            View::share('seoH1', $h1);
            View::share('seoH2', $h2);

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

            $pageUrl   = url()->current();
            $ogLocale  = $isArabic ? 'ar_SA' : 'en_US';
            $imageUrl  = $blog->image ? asset($blog->image) : asset('assets/images/Logo.png');
            $blogsUrl  = route('blogs');

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
            JsonLdMulti::setTitle($articleTitle);
            JsonLdMulti::setDescription($metaDesc);
            JsonLdMulti::setType('Article');
            JsonLdMulti::setUrl($pageUrl);
            JsonLdMulti::addValue('inLanguage', $locale);
            JsonLdMulti::addValue('headline', $articleTitle);
            JsonLdMulti::addValue('image', $imageUrl);
            JsonLdMulti::addValue('datePublished', $blog->created_at?->toIso8601String());
            JsonLdMulti::addValue('dateModified', $blog->updated_at?->toIso8601String());
            JsonLdMulti::addValue('author', [
                '@type' => 'Organization',
                'name'  => $siteName,
                'url'   => config('app.url'),
            ]);
            JsonLdMulti::addValue('publisher', [
                '@type' => 'Organization',
                'name'  => $siteName,
                'logo'  => [
                    '@type' => 'ImageObject',
                    'url'   => asset('assets/images/Logo.png'),
                ],
            ]);
            JsonLdMulti::addValue('isPartOf', [
                '@type' => 'Blog',
                '@id'   => $blogsUrl,
                'name'  => __('frontend.navbar_blogs'),
                'url'   => $blogsUrl,
            ]);
            JsonLdMulti::addValue('mainEntityOfPage', [
                '@type' => 'WebPage',
                '@id'   => $pageUrl,
            ]);
            JsonLdMulti::addValue('hasPart', [
                [
                    '@type' => 'ImageObject',
                    'url'   => $imageUrl,
                    'name'  => $altText,
                ],
            ]);

            View::share('seoH1', $h1);
            View::share('seoH2', $h2);

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

            $pageUrl     = url()->current();
            $ogLocale    = $isArabic ? 'ar_SA' : 'en_US';
            $imageUrl    = $project->image ? asset($project->image) : asset('assets/images/Logo.png');
            $projectsUrl = route('projects');

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
            JsonLdMulti::setTitle($projectName);
            JsonLdMulti::setDescription($metaDesc);
            JsonLdMulti::setType('WebPage');
            JsonLdMulti::setUrl($pageUrl);
            JsonLdMulti::addValue('inLanguage', $locale);
            JsonLdMulti::addValue('name', $projectName);
            JsonLdMulti::addValue('image', $imageUrl);
            JsonLdMulti::addValue('about', [
                '@type' => 'Organization',
                'name'  => $siteName,
                'url'   => config('app.url'),
            ]);
            JsonLdMulti::addValue('isPartOf', [
                '@type' => 'WebPage',
                '@id'   => $projectsUrl,
                'name'  => __('frontend.navbar_projects'),
                'url'   => $projectsUrl,
            ]);

            $hasParts = [['@type' => 'ImageObject', 'url' => $imageUrl, 'name' => $altText]];
            foreach ($project->media->filter(fn($m) => str_starts_with((string) $m->mime_type, 'image/')) as $m) {
                $hasParts[] = ['@type' => 'ImageObject', 'url' => asset($m->path), 'name' => $projectName];
            }
            JsonLdMulti::addValue('hasPart', $hasParts);

            View::share('seoH1', $h1);
            View::share('seoH2', $h2);

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
