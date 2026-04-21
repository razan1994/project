<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cache;


class SeoPage extends Model
{
    protected $guarded = [];

    protected static function booted(): void
    {
        static::saved(function (self $page) {
            Cache::forget("seo-page:{$page->name}");
        });
    }

    public static function getCached(string $name): ?self
    {
        return Cache::rememberForever("seo-page:{$name}", function () use ($name) {
            return self::where('name', $name)->first();
        });
    }

    protected function title(): Attribute
    {
        return Attribute::make(
            get: fn() => Config::get('app.locale') == 'ar' ? $this->seo_title_ar : $this->seo_title_en,
        );
    }

    protected function description(): Attribute
    {
        return Attribute::make(
            get: fn() => Config::get('app.locale') == 'ar' ? $this->meta_desc_ar : $this->meta_desc_en,
        );
    }

    protected function metaDesc(): Attribute
    {
        return Attribute::make(
            get: fn() => Config::get('app.locale') == 'ar' ? $this->meta_desc_ar : $this->meta_desc_en,
        );
    }

    protected function keywords(): Attribute
    {
        return Attribute::make(
            get: fn() => Config::get('app.locale') == 'ar' ? $this->keywords_ar : $this->keywords_en,
        );
    }

    protected function metaTitle(): Attribute
    {
        return Attribute::make(
            get: fn() => Config::get('app.locale') == 'ar' ? $this->seo_title_ar : $this->seo_title_en,
        );
    }

    protected function h1(): Attribute
    {
        return Attribute::make(
            get: fn() => Config::get('app.locale') == 'ar' ? $this->h1_val_ar : $this->h1_val_en,
        );
    }
    protected function h2(): Attribute
    {
        return Attribute::make(
            get: fn() => Config::get('app.locale') == 'ar' ? $this->h2_val_ar : $this->h2_val_en,
        );
    }
    protected function redirect301(): Attribute
    {
        return Attribute::make(
            get: fn() => Config::get('app.locale') == 'ar' ? $this->redirect_301_ar : $this->redirect_301_en,
        );
    }

    protected function altText(): Attribute
    {
        return Attribute::make(
            get: fn() => Config::get('app.locale') == 'ar' ? $this->alt_text_ar : $this->alt_text_en,
        );
    }

    public static function pageNames(): array
    {
        return [
            'home'                  => 'Home',
            'about_us'              => 'About Us',
            'services'              => 'Services',
            'projects'              => 'Projects',
            'design_build_projects' => 'Design & Build Projects',
            'contact_us'            => 'Contact Us',
            'blogs'                 => 'Blogs',
            'faqs'                  => 'FAQs',
            'terms_and_conditions'  => 'Terms & Conditions',
            'privacy_policy'        => 'Privacy Policy',
            'gallery'               => 'Gallery',
        ];
    }

    public function getDisplayNameAttribute(): string
    {
        return self::pageNames()[$this->name] ?? ucwords(str_replace('_', ' ', $this->name));
    }
}
