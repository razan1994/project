<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title_ar')->nullable();
            $table->string('title_en')->nullable();
            $table->longText('desc_ar')->nullable();
            $table->longText('desc_en')->nullable();
            $table->longText('image')->nullable();
            $table->boolean('status')->default(1);
            // SEO fields
            $table->longText('alias_name_ar')->nullable();
            $table->longText('alias_name_en')->nullable();
            $table->longText('meta_desc_ar')->nullable();
            $table->longText('meta_desc_en')->nullable();
            $table->longText('keywords_ar')->nullable();
            $table->longText('keywords_en')->nullable();
            $table->longText('seo_title_ar')->nullable();
            $table->longText('seo_title_en')->nullable();
            $table->longText('alt_text_ar')->nullable();
            $table->longText('alt_text_en')->nullable();
            $table->longText('image_title_text_ar')->nullable();
            $table->longText('image_title_text_en')->nullable();
            $table->longText('h1_val_ar')->nullable();
            $table->longText('h1_val_en')->nullable();
            $table->longText('h2_val_ar')->nullable();
            $table->longText('h2_val_en')->nullable();
            $table->longText('redirect_301_ar')->nullable();
            $table->longText('redirect_301_en')->nullable();
            $table->longText('tags_ar')->nullable();
            $table->longText('tags_en')->nullable();

            // Timestamps and Soft Deletes
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
