<?php

namespace App\Console\Commands;

use App\Models\Blog;
use App\Models\Project;
use App\Models\Service;
use Illuminate\Console\Command;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\SitemapIndex;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Generate the sitemap index with separate sitemaps for pages, services, projects, and blogs';

    private array $locales;
    private string $baseUrl;

    public function handle(): int
    {
        $this->locales = array_keys(LaravelLocalization::getSupportedLocales());
        $this->baseUrl = rtrim(config('app.url'), '/');

        $this->info('Generating sitemaps...');

        $this->generatePagesSitemap();
        $this->generateServicesSitemap();
        $this->generateProjectsSitemap();
        $this->generateBlogsSitemap();

        SitemapIndex::create()
            ->add("{$this->baseUrl}/sitemaps/pages.xml")
            ->add("{$this->baseUrl}/sitemaps/services.xml")
            ->add("{$this->baseUrl}/sitemaps/projects.xml")
            ->add("{$this->baseUrl}/sitemaps/blogs.xml")
            ->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap index generated at /sitemap.xml');

        return self::SUCCESS;
    }

    /**
     * Build a localized URL by resolving the translated route segment for the given locale.
     * The translation keys must match lang/{locale}/routes.php keys.
     */
    private function buildUrl(string $locale, string $transKey, string $extra = ''): string
    {
        if ($transKey === '') {
            // Home page: just /{locale}
            return "{$this->baseUrl}/{$locale}";
        }

        $segment = trans("routes.{$transKey}", [], $locale);
        $base    = "{$this->baseUrl}/{$locale}/{$segment}";

        return $extra !== '' ? rtrim($base, '/') . '/' . ltrim($extra, '/') : $base;
    }

    private function ensureSitemapsDirectory(): void
    {
        $dir = public_path('sitemaps');
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
    }

    // -------------------------------------------------------------------------
    // Static pages
    // -------------------------------------------------------------------------

    private function generatePagesSitemap(): void
    {
        $this->ensureSitemapsDirectory();

        $sitemap = Sitemap::create();
        $now     = now();

        $staticRoutes = [
            ['transKey' => '',                    'priority' => 1.0, 'freq' => Url::CHANGE_FREQUENCY_DAILY],
            ['transKey' => 'services',            'priority' => 0.9, 'freq' => Url::CHANGE_FREQUENCY_WEEKLY],
            ['transKey' => 'projects',            'priority' => 0.9, 'freq' => Url::CHANGE_FREQUENCY_WEEKLY],
            ['transKey' => 'blogs',               'priority' => 0.8, 'freq' => Url::CHANGE_FREQUENCY_WEEKLY],
            ['transKey' => 'about_us',            'priority' => 0.6, 'freq' => Url::CHANGE_FREQUENCY_MONTHLY],
            ['transKey' => 'contact_us',          'priority' => 0.6, 'freq' => Url::CHANGE_FREQUENCY_MONTHLY],
            ['transKey' => 'gallery',             'priority' => 0.6, 'freq' => Url::CHANGE_FREQUENCY_MONTHLY],
            ['transKey' => 'faqs',                'priority' => 0.5, 'freq' => Url::CHANGE_FREQUENCY_MONTHLY],
            ['transKey' => 'design_build_project','priority' => 0.7, 'freq' => Url::CHANGE_FREQUENCY_MONTHLY],
            ['transKey' => 'terms_and_conditions','priority' => 0.3, 'freq' => Url::CHANGE_FREQUENCY_YEARLY],
            ['transKey' => 'privacy_policy',      'priority' => 0.3, 'freq' => Url::CHANGE_FREQUENCY_YEARLY],
        ];

        foreach ($staticRoutes as $route) {
            foreach ($this->locales as $locale) {
                $url = $this->buildUrl($locale, $route['transKey']);

                $tag = Url::create($url)
                    ->setPriority($route['priority'])
                    ->setChangeFrequency($route['freq'])
                    ->setLastModificationDate($now);

                foreach ($this->locales as $altLocale) {
                    $tag->addAlternate($this->buildUrl($altLocale, $route['transKey']), $altLocale);
                }

                $sitemap->add($tag);
            }
        }

        $sitemap->writeToFile(public_path('sitemaps/pages.xml'));
        $this->info('  - pages.xml generated');
    }

    // -------------------------------------------------------------------------
    // Services
    // -------------------------------------------------------------------------

    private function generateServicesSitemap(): void
    {
        $this->ensureSitemapsDirectory();

        $sitemap = Sitemap::create();

        Service::query()
            ->where('status', 1)
            ->select('id', 'alias_name_en', 'alias_name_ar', 'updated_at')
            ->chunk(500, function ($services) use ($sitemap) {
                foreach ($services as $service) {
                    foreach ($this->locales as $locale) {
                        $slug = $locale === 'ar'
                            ? ($service->alias_name_ar ?: $service->id)
                            : ($service->alias_name_en ?: $service->id);

                        $url = $this->buildUrl($locale, 'services', $slug);

                        $tag = Url::create($url)
                            ->setPriority(0.8)
                            ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                            ->setLastModificationDate($service->updated_at);

                        foreach ($this->locales as $altLocale) {
                            $altSlug = $altLocale === 'ar'
                                ? ($service->alias_name_ar ?: $service->id)
                                : ($service->alias_name_en ?: $service->id);
                            $tag->addAlternate($this->buildUrl($altLocale, 'services', $altSlug), $altLocale);
                        }

                        $sitemap->add($tag);
                    }
                }
            });

        $sitemap->writeToFile(public_path('sitemaps/services.xml'));
        $this->info('  - services.xml generated');
    }

    // -------------------------------------------------------------------------
    // Projects
    // -------------------------------------------------------------------------

    private function generateProjectsSitemap(): void
    {
        $this->ensureSitemapsDirectory();

        $sitemap = Sitemap::create();

        Project::query()
            ->where('status', 1)
            ->select('id', 'alias_name_en', 'alias_name_ar', 'updated_at')
            ->chunk(500, function ($projects) use ($sitemap) {
                foreach ($projects as $project) {
                    foreach ($this->locales as $locale) {
                        $slug = $locale === 'ar'
                            ? ($project->alias_name_ar ?: $project->id)
                            : ($project->alias_name_en ?: $project->id);

                        $url = $this->buildUrl($locale, 'projects', $slug);

                        $tag = Url::create($url)
                            ->setPriority(0.7)
                            ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                            ->setLastModificationDate($project->updated_at);

                        foreach ($this->locales as $altLocale) {
                            $altSlug = $altLocale === 'ar'
                                ? ($project->alias_name_ar ?: $project->id)
                                : ($project->alias_name_en ?: $project->id);
                            $tag->addAlternate($this->buildUrl($altLocale, 'projects', $altSlug), $altLocale);
                        }

                        $sitemap->add($tag);
                    }
                }
            });

        $sitemap->writeToFile(public_path('sitemaps/projects.xml'));
        $this->info('  - projects.xml generated');
    }

    // -------------------------------------------------------------------------
    // Blogs
    // -------------------------------------------------------------------------

    private function generateBlogsSitemap(): void
    {
        $this->ensureSitemapsDirectory();

        $sitemap = Sitemap::create();

        Blog::query()
            ->where('status', 1)
            ->select('id', 'alias_name_en', 'alias_name_ar', 'updated_at')
            ->chunk(500, function ($blogs) use ($sitemap) {
                foreach ($blogs as $blog) {
                    foreach ($this->locales as $locale) {
                        $slug = $locale === 'ar'
                            ? ($blog->alias_name_ar ?: $blog->id)
                            : ($blog->alias_name_en ?: $blog->id);

                        $url = $this->buildUrl($locale, 'blogs', $slug);

                        $tag = Url::create($url)
                            ->setPriority(0.6)
                            ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                            ->setLastModificationDate($blog->updated_at);

                        foreach ($this->locales as $altLocale) {
                            $altSlug = $altLocale === 'ar'
                                ? ($blog->alias_name_ar ?: $blog->id)
                                : ($blog->alias_name_en ?: $blog->id);
                            $tag->addAlternate($this->buildUrl($altLocale, 'blogs', $altSlug), $altLocale);
                        }

                        $sitemap->add($tag);
                    }
                }
            });

        $sitemap->writeToFile(public_path('sitemaps/blogs.xml'));
        $this->info('  - blogs.xml generated');
    }
}
