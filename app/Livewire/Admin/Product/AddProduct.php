<?php

namespace App\Livewire\Admin\Product;

use App\Models\Brands;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use App\Models\Product\Categories;
use App\Models\Product\ProductAssets;
use App\Models\Product\Products;
use App\Models\Product\ProductVariations;
use App\Models\Vendors;
use Monarobase\CountryList\CountryListFacade;

class AddProduct extends Component
{
    use WithFileUploads;

    public $title = 'Add Product';

    public $breadCrumb = 'Home.Product.Add';

    #[Validate('required|min:3', message: 'Please provide a product name')]
    public $name = '';
    public $description = '';
    #[Validate('required', message: 'Please add a product price')]
    public $price = 0;
    #[Validate('image|max:1024', message: 'Please add a product thumbnail')]
    public $thumbnail = '';
    public $showThumbnail = '';
    #[Validate('required', message: 'Please select a product category')]
    public $category;
    public $discountType = 0;
    public $discountData = null;
    #[Validate('required', message: 'Please select a product status')]
    public $status = '';
    public $sameDay = 0;
    public $vat = 0;
    #[Validate('required|min:3', message: 'Please select a product sku')]
    public $sku;
    #[Validate('required', message: 'Please enter a product quantity')]
    public $onSQty = 0;
    public $onWQty = 0;
    public $backOrder = 0;
    #[Validate('required', message: 'Please enter a product weight')]
    public $weight = 0;
    #[Validate('required', message: 'Please enter a product length')]
    public $length = 0;
    #[Validate('required', message: 'Please enter a product width')]
    public $width = 0;
    #[Validate('required', message: 'Please enter a product height')]
    public $height = 0;
    #[Validate('required', message: 'Please select a product brand')]
    public $brand;
    public $metaTitle;
    public $metaDescription;
    public $metaTags;
    #[Validate(['assets.*' => [
        'required',
        'image',
        'max:21024',
    ]], message: [
        'assets.*.required' => 'Assets are required',
        'assets.*' => 'Each asset must be an image not exceeding 20 MB',
    ])]
    public $assets = [];
    public $hasAssets = [];
    public $variations = [['id' => 0, 'type' => '', 'data' => '', 'hasPrice' => '', 'thumbnail' => '', 'showThumbnail' => '']];

    public $searchVendor;

    public $searchList;

    public $vendor = [];

    public $product;

    public $featured = 0;

    public function mount($productID = null)
    {
        if ($productID) {
            $this->title = 'Update Product';
            $this->breadCrumb = 'Home.Product.Update';

            $this->product = Products::with(['assets', 'variations', 'vendor'])->find($productID);

            if ($this->product) {

                $product = $this->product;
                $this->variations = [];
                $this->name = $product->name;
                $this->description = $product->description;
                $this->price = $product->amount;
                $this->showThumbnail = $product->thumbnail;
                $this->category = $product->category;
                $this->discountType = $product->discountType;
                $this->discountData = $product->discountData;
                $this->status = $product->status;
                $this->sameDay = $product->shippingType;
                $this->vat = $product->vat;
                $this->sku = $product->sku;
                $this->onSQty = $product->qty;
                $this->onWQty = $product->wQty;
                $this->backOrder = $product->backOrder;
                $this->weight = $product->weight;
                $this->length = $product->length;
                $this->width = $product->width;
                $this->height = $product->height;
                $this->metaTitle = $product->metaTagTitle;
                $this->metaDescription = $product->metaTagDescription;
                $this->featured = $product->isFeatured;
                $this->brand = $product->hasBrand;
                $this->metaTags = json_validate($product->metaTagKeywords) ? json_decode($product->metaTagKeywords) : [];
                $this->hasAssets = $product->assets;
                foreach ($product->variations as $key => $value) {
                    $this->variations[] = ['id' => $value['id'], 'type' => $value['type'], 'data' => $value['data'], 'hasPrice' => $value['hasPrice'], 'showThumbnail' => $value['thumbnail']];
                }

                if ($product->vendor) {
                    $this->vendor = [
                        'id' => $product->vendor->id,
                        'fname' => $product->vendor->name,
                        'company' => $product->vendor->company,
                        'phone' => $product->vendor->phone,
                        'email' => $product->vendor->email,
                        'address' => $product->vendor->address,
                        'address2' => $product->vendor->address2,
                        'city' => $product->vendor->city,
                        'state' => $product->vendor->state,
                        'postalCode' => $product->vendor->postalCode,
                        'country' => $product->vendor->country,
                    ];
                }
            }
        }
    }

    #[Computed]
    public function country()
    {
        return CountryListFacade::getOne('PK', 'en');;
    }

    #[Computed]
    public function categories()
    {
        $categories = [];
        $category = Categories::with(['descendants'])->get();
        foreach ($category as $key => $cat) {
            $categories[$cat->id] = $cat->name;
            if ($cat->descendants->count()) {
                foreach ($cat->descendants as $child) {
                    $categories[$child->id] = $cat->name . '->' . $child->name;
                }
            }
        }

        return $categories;
    }

    #[Computed]
    public function brands()
    {
        $brands = [];
        $brand = Brands::get();
        foreach ($brand as $key => $brd) {
            $brands[$brd->id] = $brd->name;
        }

        return $brands;
    }


    public function addVariations()
    {
        $index = count($this->variations);
        $this->variations[$index] = ['id' => 0, 'type' => '', 'data' => '', 'hasPrice' => '', 'thumbnail' => ''];

        $this->dispatch('hide-loader');
    }

    public function deleteVariations($index)
    {
        if (isset($this->variations[$index])) {
            if (isset($this->variations[$index]['id'])) {
                ProductVariations::where('id', $this->variations[$index]['id'])->delete();
            }
            unset($this->variations[$index]);
        }
        $variations = [];

        foreach ($this->variations as $key => $value) {
            $variations[] = $value;
        }

        $this->variations = $variations;

        $this->dispatch('hide-loader');
    }

    public function setDefaultAsset($id)
    {
        $asset = ProductAssets::find($id);
        if ($asset) {
            ProductAssets::where('productID', $this->product->id)->update(['isDefault' => false]);
            $asset->update(['isDefault' => true]);
        }
    }
    public function deleteAsset($id)
    {
        ProductAssets::find($id)->delete();
        if ($this->product) {
            $this->hasAssets = ProductAssets::where('productID', $this->product->id)->get();
        }
    }

    public function setVendor($vendor)
    {
        $this->vendor = [
            'id' => $vendor['id'],
            'fname' => $vendor['name'],
            'company' => $vendor['company'],
            'phone' => $vendor['phone'],
            'email' => $vendor['email'],
            'address' => $vendor['address'],
            'address2' => $vendor['address2'],
            'city' => $vendor['city'],
            'state' => $vendor['state'],
            'postalCode' => $vendor['postalCode'],
            'country' => $vendor['country'],
        ];

        $this->searchVendor = null;
    }

    public function hasVendor()
    {
        $hasVendor = 0;
        if (isset($this->vendor['id'])) {
            $hasVendor = $this->vendor['id'];
        } elseif (isset($this->vendor['fname']) && $this->vendor['phone']) {
            $vendor = Vendors::create([
                'name' => $this->vendor['fname'],
                'company' => $this->vendor['company'],
                'phone' => $this->vendor['phone'],
                'email' => $this->vendor['email'],
                'address' => $this->vendor['address'],
                'address2' => $this->vendor['address2'],
                'city' => $this->vendor['city'],
                'state' => $this->vendor['state'],
                'postalCode' => $this->vendor['postalCode'],
                'country' => $this->vendor['country'],
            ]);
            $hasVendor = $vendor->id;
        }
        return $hasVendor;
    }

    public function updateProduct()
    {
        $this->dispatch('hide-loader');

        $this->validate();

        $data = [];

        if ($this->product) {

            $hasVendor = $this->hasVendor();

            if ($this->thumbnail) {
                $file = $this->thumbnail;

                $name = $file->getClientOriginalName();

                $path = $file->storeAs('products', $name, ['disk' => 'public']);
                $data += ['thumbnail' => isset($path) && !empty($path) ? asset($path) : ''];
            }

            $data += [
                'name' => $this->name,
                'description' => $this->description,
                'amount' => $this->price,

                'category' => $this->category,
                'discountType' => $this->discountType,
                'discountData' => $this->discountData,
                'status' => $this->status,
                'shippingType' => $this->sameDay,
                'vat' => $this->vat,
                'vat' => $this->vat,
                'sku' => $this->sku,
                'qty' => $this->onSQty,
                'wQty' => $this->onWQty,
                'backOrder' => $this->backOrder,
                'weight' => $this->weight,
                'length' => $this->length,
                'width' => $this->width,
                'height' => $this->height,
                'metaTagTitle' => $this->metaTitle,
                'metaTagDescription' => $this->metaDescription,
                'metaTagKeywords' => json_encode($this->metaTags),
                'hasVendor' => $hasVendor,
                'hasBrand' => $this->brand,
                'isFeatured' => $this->featured,
            ];

            $product = $this->product->update($data);

            $path = null;

            $assets = $this->assets;

            if ($assets) {
                foreach ($assets as $key => $asset) {
                    $file = $asset;

                    $name = $file->getClientOriginalName();

                    $type = $file->getClientMimeType();

                    $path = $file->storeAs('products', $name, ['disk' => 'public']);

                    ProductAssets::create([
                        'path' => $path,
                        'type' => 'assets',
                        'assetType' => $type,
                        'productID' => $this->product->id,
                    ]);

                    $path = null;
                }
            }

            if ($this->variations) {
                foreach ($this->variations as $key => $value) {
                    if (isset($value['thumbnail']) && !empty($value['thumbnail'])) {
                        $file = $value['thumbnail'];

                        $name = $file->getClientOriginalName();

                        $path = $file->storeAs('products', $name, ['disk' => 'public']);
                    }
                    ProductVariations::create([
                        'type' => $value['type'],
                        'data' => $value['data'],
                        'hasPrice' => $value['hasPrice'] ?: 0,
                        'thumbnail' => isset($path) && !empty($path) ? asset($path) : '',
                        'productID' => $this->product->id,
                    ]);
                }
            }
        }
    }

    public function saveProduct()
    {
        $this->dispatch('hide-loader');

        $this->validate();

        $hasVendor = $this->hasVendor();

        if ($this->thumbnail) {
            $file = $this->thumbnail;

            $name = $file->getClientOriginalName();

            $path = $file->storeAs('products', $name, ['disk' => 'public']);
        }

        $product = Products::create([
            'name' => $this->name,
            'description' => $this->description,
            'amount' => $this->price,
            'thumbnail' => isset($path) && !empty($path) ? asset($path) : '',
            'category' => $this->category,
            'discountType' => $this->discountType,
            'discountData' => $this->discountData,
            'status' => $this->status,
            'shippingType' => $this->sameDay,
            'vat' => $this->vat,
            'vat' => $this->vat,
            'sku' => $this->sku,
            'qty' => $this->onSQty,
            'wQty' => $this->onWQty,
            'backOrder' => $this->backOrder,
            'weight' => $this->weight,
            'length' => $this->length,
            'width' => $this->width,
            'height' => $this->height,
            'metaTagTitle' => $this->metaTitle,
            'metaTagDescription' => $this->metaDescription,
            'metaTagKeywords' => json_encode($this->metaTags),
            'hasVendor' => $hasVendor,
            'hasBrand' => $this->brand,
            'isFeatured' => $this->featured,
        ]);

        $path = null;

        $assets = $this->assets;

        if ($assets) {
            foreach ($assets as $key => $asset) {
                $file = $asset;

                $name = $file->getClientOriginalName();

                $type = $file->getClientMimeType();

                $path = $file->storeAs('products', $name, ['disk' => 'public']);

                ProductAssets::create([
                    'path' => $path,
                    'type' => 'assets',
                    'assetType' => $type,
                    'productID' => $product->id,
                ]);

                $path = null;
            }
        }

        if ($this->variations) {
            ProductVariations::where('productID', $product->id)->delete();

            foreach ($this->variations as $key => $value) {
                if (isset($value['thumbnail']) && $value['thumbnail'] !== null && $value['thumbnail'] !== '') {
                    $file = $value['thumbnail'];

                    var_dump($value);

                    $name = $file->getClientOriginalName();

                    $path = $file->storeAs('products', $name, ['disk' => 'public']);
                }
                ProductVariations::create([
                    'type' => $value['type'],
                    'data' => $value['data'],
                    'hasPrice' => $value['hasPrice'] ?: 0,
                    'thumbnail' => isset($path) && !empty($path) ? asset($path) : '',
                    'productID' => $product->id,
                ]);
            }
        }

        $this->clear();
    }

    public function clear()
    {
        $this->name = '';
        $this->description = '';
        $this->price = 0;
        $this->thumbnail = '';
        $this->showThumbnail = '';
        $this->category = null;
        $this->discountType = 0;
        $this->discountData = null;
        $this->status = '';
        $this->sameDay = 0;
        $this->vat = 0;
        $this->sku = null;
        $this->onSQty = 0;
        $this->onWQty = 0;
        $this->backOrder = 0;
        $this->weight = 0;
        $this->length = 0;
        $this->width = 0;
        $this->height = 0;
        $this->featured = 0;
        $this->brand = null;
        $this->metaTitle = null;
        $this->metaDescription = null;
        $this->metaTags = null;
        $this->assets = [];
        $this->variations = [['type' => '', 'data' => '', 'hasPrice' => '', 'thumbnail' => '']];

        $this->vendor = [];
    }

    public function updated($property)
    {
        if ($property == 'searchVendor') {

            if ($this->searchVendor) {
                $this->searchList = Vendors::where('company', 'LIKE', '%' . $this->searchVendor . '%')->orWhere('name', 'LIKE', '%' . $this->searchVendor . '%')->orWhere('phone', 'LIKE', '%' . $this->searchVendor . '%');
            } else {
                $this->searchVendor = null;
            }
        }
        $this->dispatch('hide-loader');
    }

    #[Computed]
    public function searchData()
    {
        $searchData = [];
        if ($this->searchList) {
            $this->searchList = $this->searchList->orderBy('id', 'DESC')->get();
            foreach ($this->searchList as $key => $value) {
                $searchData[] = $value;
            }
        }
        return $searchData;
    }


    public function render()
    {
        return view('livewire.admin.product.add-product')->extends('admin.layout.master', ['title' => $this->title, 'breadCrumb' => $this->breadCrumb])->section('content');
    }
}
