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
        Schema::table('products', function (Blueprint $table) {
            $table->integer('wQty')->default(0)->after('qty');
            $table->float('vat')->default(0)->after('amount');
            $table->float('weight')->default(0)->after('height');
            $table->text('thumbnail')->nullable()->after('id');
            $table->integer('status')->default(0)->after('thumbnail');
            $table->boolean('backOrder')->default(0)->after('shippingType');
        });
        Schema::table('product_variations', function (Blueprint $table) {
            $table->float('hasPrice')->default(0)->after('data');
            $table->text('thumbnail')->nullable()->after('hasPrice');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
