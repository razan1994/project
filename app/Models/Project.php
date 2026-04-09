<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Config;

class Project extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    // ==============================
    // Accessors & Mutators
    // ==============================
    protected function slug(): Attribute
    {
        return Attribute::make(
            get: fn() => Config::get('app.locale') == 'ar' ? $this->alias_name_ar : $this->alias_name_en,
        );
    }

    protected function title(): Attribute
    {
        return Attribute::make(
            get: fn() => Config::get('app.locale') == 'ar' ? $this->title_ar : $this->title_en,
        );
    }

    protected function description(): Attribute
    {
        return Attribute::make(
            get: fn() => Config::get('app.locale') == 'ar' ? $this->desc_ar : $this->desc_en,
        );
    }

    protected function seoTitle(): Attribute
    {
        return Attribute::make(
            get: fn() => Config::get('app.locale') == 'ar' ? $this->seo_title_ar : $this->seo_title_en,
        );
    }

    protected function subDescription(): Attribute
    {
        return Attribute::make(
            get: fn() => Config::get('app.locale') == 'ar' ? $this->sub_desc_ar : $this->sub_desc_en,
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
    protected function imageTitle(): Attribute
    {
        return Attribute::make(
            get: fn() => Config::get('app.locale') == 'ar' ? $this->image_title_text_ar : $this->image_title_text_en,
        );
    }

    // ====================
    // Relationships
    // ====================

    public function media()
    {
        return $this->hasMany(ProjectImage::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
