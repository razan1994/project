<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeoSection extends Model
{
    protected $fillable = [
        'title_ar',
        'title_en',
        'desc_ar',
        'desc_en',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'status' => 'boolean',
        ];
    }
}
