<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class ContactUs extends Model
{
    use HasFactory;

    // ===================================================================================================================
    // ============================================== Standard Section ===================================================
    // ===================================================================================================================
    protected $table = 'contact_us';
    protected $guarded = [];

        // ==============================
    // Accessors & Mutators
    // ==============================
    protected function address(): Attribute
    {
        return Attribute::make(
            get: fn() => Config::get('app.locale') == 'ar' ? $this->address_ar : $this->address_en,
        );
    }

}
