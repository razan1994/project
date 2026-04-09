<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Category extends Model
{
    protected $guarded = [];

    protected function title(): Attribute
    {
        return Attribute::make(
            get: fn() => Config::get('app.locale') == 'ar' ? $this->title_ar : $this->title_en,
        );
    }

    // ====================
    // Relationships
    // ====================

    public function projects()
    {
        return $this->hasMany(Project::class)->where('status', 1)->orderBy('order', 'asc');
    }
}
