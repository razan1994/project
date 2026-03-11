<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceMedia extends Model
{
    use HasFactory;

    protected $guarded = [];

    // ==============================
    // Relationships
    // ==============================
    public function program()
    {
        return $this->belongsTo(Service::class);
    }
}
