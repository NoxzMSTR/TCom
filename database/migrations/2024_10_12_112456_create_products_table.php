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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->text('sku');
            $table->text('name');
            $table->longText('description')->nullable();
            $table->float('amount')->default(0);
            $table->integer('qty')->default(1);
            $table->float('length')->default(0);
            $table->float('width')->default(0);
            $table->float('height')->default(0);
            $table->string('discountType')->nullable();
            $table->json('discountData')->nullable();
            $table->text('trackingNo')->nullable();
            $table->text('metaTagTitle')->nullable();
            $table->text('metaTagDescription')->nullable();
            $table->text('metaTagKeywords')->nullable();
            $table->text('shippingType')->nullable();
            $table->bigInteger('hasVendor')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
