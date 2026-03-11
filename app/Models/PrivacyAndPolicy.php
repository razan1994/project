<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Casts\Attribute;

class PrivacyAndPolicy extends Model
{
    use HasFactory;
    protected $guarded = [];

    // ==============================
    // Accessors & Mutators
    // ==============================
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
}
