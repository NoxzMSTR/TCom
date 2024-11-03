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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('orderNo');
            $table->string('invoiceNo');
            $table->text('invoicePath');

            $table->string('userRole');
            $table->unsignedBigInteger('userID');
            $table->string('userFirstName');
            $table->string('userLastName');
            $table->string('userEmail')->nullable();
            $table->string('userPhone')->nullable();

            $table->string('shippingPostalCode')->nullable();
            $table->string('shippingFirstName')->nullable();
            $table->string('shippingLastName')->nullable();
            $table->string('shippingEmail')->nullable();
            $table->string('shippingPhone')->nullable();
            $table->text('shippingAddress')->nullable();
            $table->text('shippingAddress2')->nullable();
            $table->string('shippingCity')->nullable();
            $table->string('shippingRegion')->nullable();
            $table->string('shippingCountry')->nullable();

            $table->string('deliveryPostalCode');
            $table->string('deliveryFirstName');
            $table->string('deliveryLastName');
            $table->string('deliveryEmail')->nullable();
            $table->string('deliveryPhone')->nullable();
            $table->text('deliveryAddress');
            $table->text('deliveryAddress2')->nullable();
            $table->string('deliveryCity')->nullable();
            $table->string('deliveryRegion')->nullable();
            $table->string('deliveryCountry')->nullable();

            $table->text('trackingNo')->nullable();
            $table->json('trackingData')->nullable();
            $table->boolean('isPaid')->default(0);

            $table->float('shippingCharges')->default(0);
            $table->float('taxAmount')->default(0);
            $table->float('total')->default(0);
            $table->text('status');
            $table->integer('bookerID');
            $table->text('bookerNotes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
