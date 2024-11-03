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
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('shippingFirstName');
            $table->dropColumn('shippingLastName');
            $table->dropColumn('shippingEmail');
            $table->dropColumn('shippingPhone');
            $table->dropColumn('deliveryFirstName');
            $table->dropColumn('deliveryLastName');
            $table->dropColumn('deliveryEmail');
            $table->dropColumn('deliveryPhone');
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
