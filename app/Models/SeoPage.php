<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class SeoPage extends Model
{
    protected $guarded = [];

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
}
