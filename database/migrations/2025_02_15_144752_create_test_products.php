<?php

use App\Models\Product\Products;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $products = Products::all();
        // foreach ($products as $key => $pro) {
        //     for ($i = 0; $i < 2000; $i++) {
        //         $product = Products::create([
        //             'name' => $i . '-' . $pro->name,
        //             'description' => $pro->description,
        //             'shortDescription' => $pro->shortDescription,
        //             'amount' => $pro->amount,
        //             'thumbnail' => $pro->thumbnail,
        //             'category' => $pro->category,
        //             'discountType' => $pro->discountType,
        //             'discountData' => $pro->discountData,
        //             'status' => $pro->status,
        //             'shippingType' => $pro->shippingType,
        //             'vat' => $pro->vat,
        //             'sku' => $i . '-' . $pro->sku,
        //             'qty' => $pro->qty,
        //             'wQty' => $pro->wQty,
        //             'backOrder' => $pro->backOrder,
        //             'weight' => $pro->weight,
        //             'length' => $pro->length,
        //             'width' => $pro->width,
        //             'height' => $pro->height,
        //             'metaTagTitle' => $pro->metaTagTitle,
        //             'metaTagDescription' => $pro->metaTagDescription,
        //             'metaTagKeywords' => ($pro->metaTagKeywords),
        //             'hasVendor' => $pro->hasVendor,
        //             'hasBrand' => $pro->hasBrand,
        //             'isFeatured' => $pro->isFeatured,
        //             'isOffer' => $pro->isOffer,
        //         ]);

        //         foreach ($product->tags as $key => $tag) {
        //             ProductTags::create([
        //                 'tag' => $tag->tag,
        //                 'productID' => $product->id,
        //             ]);
        //         }

        //         foreach ($product->assets as $key => $asset) {
        //             ProductAssets::create([
        //                 'path' => $asset->path,
        //                 'type' => 'assets',
        //                 'assetType' => $asset->assetType,
        //                 'productID' => $product->id,
        //             ]);
        //         }

        //         foreach ($product->variations as $key => $value) {
        //             ProductVariations::create([
        //                 'type' => $value->type,
        //                 'data' => $value->data,
        //                 'hasPrice' => $value->hasPrice,
        //                 'thumbnail' => $value->thumbnail,
        //                 'productID' => $product->id,
        //             ]);
        //         }

        //         foreach ($product->specification as $key => $value) {
        //             ProductSpecification::create([
        //                 'title' => $value->title,
        //                 'key' => $value->name,
        //                 'value' => $value->value,
        //                 'productID' => $product->id,
        //             ]);
        //         }
        //     }
        // }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {}
};