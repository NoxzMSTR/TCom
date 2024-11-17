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
        Schema::create('systems', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('logoLight');
            $table->text('logoDark');
            $table->text('favconLogo');
            $table->text('privacyPolicy')->nullable();
            $table->text('termsNCondition')->nullable();
            $table->text('aboutUs')->nullable();
            $table->string('facebookLink')->nullable();
            $table->string('instagramLink')->nullable();
            $table->string('pinterestLink')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('systems');
    }
};
