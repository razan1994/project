<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultationRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_name',
        'contact_number',
        'preferred_time',
        'building_type',
        'approved_design',
        'land_area',
        'construction_area',
        'attachments',
    ];

    protected $casts = [
        'attachments' => 'array',
    ];
}
