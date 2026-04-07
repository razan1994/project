<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('consultation_requests', function (Blueprint $table) {
            $table->id();
            $table->string('client_name');
            $table->string('contact_number');
            $table->string('preferred_time')->nullable();
            $table->string('building_type');
            $table->string('approved_design');
            $table->string('land_area')->nullable();
            $table->string('construction_area')->nullable();
            $table->json('attachments')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('consultation_requests');
    }
};
