<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Config;

class Slider extends Model
{
    use HasFactory, SoftDeletes;
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
            get: fn() => Config::get('app.locale') == 'ar' ? $this->description_ar : $this->description_en,
        );
    }

    protected function btn(): Attribute
    {
        return Attribute::make(
            get: fn() => Config::get('app.locale') == 'ar' ? $this->btn_ar : $this->btn_en,
        );
    }
}
