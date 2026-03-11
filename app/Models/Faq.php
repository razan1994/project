<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Faq extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'question_ar',
        'question_en',
        'answer_ar',
        'answer_en',
        'status',
        'order',
    ];
    protected $table = 'faqs';


    // ==============================
    // Accessors & Mutators
    // ==============================
    protected function question(): Attribute
    {
        return Attribute::make(
            get: fn() => Config::get('app.locale') == 'ar' ? $this->question_ar : $this->question_en,
        );
    }

    protected function answer(): Attribute
    {
        return Attribute::make(
            get: fn() => Config::get('app.locale') == 'ar' ? $this->answer_ar : $this->answer_en,
        );
    }

    // ====================================================
    // Scopes
    // ====================================================
    public function scopeActive($query)
    {
        return $query->where('status', 1)->orderBy('order', 'asc');
    }
}
