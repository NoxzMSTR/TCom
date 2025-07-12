<?php
namespace App\Livewire\Admin\Product;

use App\Models\Brands;
use App\Models\Product\Categories;
use App\Models\Product\ProductAssets;
use App\Models\Product\Products;
use App\Models\Product\ProductSpecification;
use App\Models\Product\ProductTags;
use App\Models\Product\ProductVariations;
use App\Models\Vendors;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Renderless;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Monarobase\CountryList\CountryListFacade;

class AddProduct extends Component
{
    use WithFileUploads;

    public $title = 'Add Product';

    public $breadCrumb = 'Home.Product.Add';

    #[Validate('required|min:3', message: 'Please provide a product name')]
    public $name = '';
    public $description = '';
    public $shortDescription = '';
    #[Validate('required', message: 'Please add a product price')]
    public $price = 0;
    public $rPrice = 0;

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
                'mimes:png,jpg,jpeg,gif,bmp',
                'max:21024',
            ]], message: [
            'assets.*.required' => 'Assets are required',
            'assets.*'          => ' Each asset must be an image in PNG, JPG, JPEG, GIF, or BMP format and should not exceed 20 MB. 📁 Please upload a valid file to proceed. ',
        ])]
    public $assets = [];
    public $hasAssets = [];
    public $variations = [['id' => 0, 'type' => '', 'data' => '', 'hasPrice' => '', 'thumbnail' => '', 'showThumbnail' => '']];

    public $searchVendor;

    public $searchList;

    public $vendor = [];

    public $specification = [];

    public $product;

    public $featured = 0;

    public $offered = 0;

    public $needAdvance = 0;

    public $offerExpireAt;

    public $used = 0;

    public function mount($productID = null)
    {
        if ($productID) {
            $this->title      = 'Update Product';
            $this->breadCrumb = 'Home.Product.Update';

            $this->product = Products::with(['assets', 'variations', 'vendor', 'specification'])->find($productID);

            if ($this->product) {

                $product                = $this->product;
                $this->variations       = [];
                $this->name             = $product->name;
                $this->description      = $product->description;
                $this->shortDescription = $product->shortDescription;
                $this->price            = $product->amount;
                $this->rPrice           = $product->retailAmount;
                $this->showThumbnail    = $product->thumbnail;
                $this->category         = $product->category;
                $this->discountType     = $product->discountType;
                $this->discountData     = $product->discountData;
                $this->status           = $product->status;
                $this->sameDay          = $product->shippingType;
                $this->vat              = $product->vat ?? 0;
                $this->sku              = $product->sku;
                $this->onSQty           = $product->qty;
                $this->onWQty           = $product->wQty;
                $this->backOrder        = $product->backOrder;
                $this->weight           = $product->weight;
                $this->length           = $product->length;
                $this->width            = $product->width;
                $this->height           = $product->height;
                $this->metaTitle        = $product->metaTagTitle;
                $this->metaDescription  = $product->metaTagDescription;
                $this->featured         = $product->isFeatured;
                $this->brand            = $product->hasBrand;
                $this->offered          = $product->isOffer;
                $this->used             = $product->isUsed;
                $this->offerExpireAt    = $product->offerExpireAt;
                $this->needAdvance      = $product->needAdvance;
                $this->metaTags         = json_validate($product->metaTagKeywords) ? json_decode($product->metaTagKeywords) : [];
                $this->hasAssets        = $product->assets;
                foreach ($product->variations as $key => $value) {
                    $this->variations[] = ['id' => $value['id'], 'type' => $value['type'], 'data' => $value['data'], 'hasPrice' => $value['hasPrice'], 'stock' => $value['stock'], 'previewThumbnail' => $value['thumbnail']];
                }
                $specification = [];
                foreach ($product->specification as $key => $value) {
                    $specification[$value['title']]['title']  = $value['title'];
                    $specification[$value['title']]['data'][] = ['id' => $value['id'], 'name' => $value['key'], 'value' => $value['value']];
                }
                $this->specification = array_values($specification);
                if ($product->vendor) {
                    $this->vendor = [
                        'id'         => $product->vendor->id,
                        'fname'      => $product->vendor->name,
                        'company'    => $product->vendor->company,
                        'phone'      => $product->vendor->phone,
                        'email'      => $product->vendor->email,
                        'address'    => $product->vendor->address,
                        'address2'   => $product->vendor->address2,
                        'city'       => $product->vendor->city,
                        'state'      => $product->vendor->state,
                        'postalCode' => $product->vendor->postalCode,
                        'country'    => $product->vendor->country,
                    ];
                }
            }
        }
    }

    #[Computed]
    public function country()
    {
        return CountryListFacade::getOne('PK', 'en');
    }

    #[Computed]
    public function categories()
    {
        $categories = [];
        $category   = Categories::with(['descendants'])->get()->toArray();
        foreach ($category as $key => $cat) {
            $categories[$key]['id']    = $cat['id'];
            $categories[$key]['name']  = $cat['name'];
            $categories[$key]['level'] = 1;
            if (isset($cat['descendants'])) {
                $categories[$key]['child'] = $this->buildCatTree($cat['descendants'], 2);
            }
        }

        return $categories;
    }

    public function buildCatTree($subCats, $level)
    {
        $categories = [];

        foreach ($subCats as $cat) {
            $menuItem = [
                'id'    => $cat['id'],
                'name'  => $cat['name'],
                'level' => $level,
            ];

            // Check if it has children and call the function recursively
            if (! empty($cat['descendants'])) {
                $menuItem['child'] = $this->buildCatTree($cat['descendants'], $level + 1);
            }

            $categories[] = $menuItem;
        }

        return $categories;
    }

    #[Computed]
    public function brands()
    {
        $brands = [];
        $brand  = Brands::get();
        foreach ($brand as $key => $brd) {
            $brands[$brd->id] = $brd->name;
        }

        return $brands;
    }

    public function addVariations()
    {
        $index                    = count($this->variations);
        $this->variations[$index] = ['id' => 0, 'type' => '', 'data' => '', 'hasPrice' => '', 'thumbnail' => ''];

        $this->dispatch('hide-loader');
    }

    #[Renderless]
    public function deleteVariations($variations, $id = null)
    {
        ProductVariations::where('id', $id)->delete();

        $this->variations = $variations;

        $this->dispatch('hide-loader');
    }

    #[Renderless]
    public function deleteSpecification($specs, $title = null)
    {
        ProductSpecification::where('title', $title)->delete();

        $this->specification = $specs;

        $this->dispatch('hide-loader');
    }
    #[Renderless]
    public function deleteField($specs, $id = null)
    {
        ProductSpecification::where('id', $id)->delete();

        $this->specification = $specs;

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
            'id'         => $vendor['id'],
            'fname'      => $vendor['name'],
            'company'    => $vendor['company'],
            'phone'      => $vendor['phone'],
            'email'      => $vendor['email'],
            'address'    => $vendor['address'],
            'address2'   => $vendor['address2'],
            'city'       => $vendor['city'],
            'state'      => $vendor['state'],
            'postalCode' => $vendor['postalCode'],
            'country'    => $vendor['country'],
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
                'name'       => $this->vendor['fname'],
                'company'    => $this->vendor['company'],
                'phone'      => $this->vendor['phone'],
                'email'      => $this->vendor['email'],
                'address'    => $this->vendor['address'],
                'address2'   => isset($this->vendor['address2']) ? $this->vendor['address2'] : '',
                'city'       => isset($this->vendor['city']) ? $this->vendor['city'] : '',
                'state'      => isset($this->vendor['state']) ? $this->vendor['state'] : '',
                'postalCode' => isset($this->vendor['postalCode']) ? $this->vendor['postalCode'] : '',
                'country'    => isset($this->vendor['country']) ? $this->vendor['country'] : 'Pakistan',
            ]);
            $hasVendor = $vendor->id;
        }
        return $hasVendor;
    }

    public function initials($str, $words = 0)
    {
        $ret   = '';
        $words = $words - 1;

        foreach (preg_split("/[\s,_-]+/", $str) as $key => $word) {
            if (isset($word[0])) {
                $ret .= strtoupper($word[0]);

                if ($words && $key == $words) {
                    break;
                }
            }
        }
        return $ret;
    }

    public function updateProduct()
    {
        $this->dispatch('hide-loader');

        $this->validate();

        $data = [];

        if ($this->product) {

            $hasVendor = $this->hasVendor();

            if ($this->thumbnail) {
                $this->validate(['thumbnail' => 'image|max:1024'], ['thumbnail' => 'Please add a category thumbnail']);
                $file = $this->thumbnail;

                $name = $file->getClientOriginalName();

                $path = $file->storeAs('products', $name, ['disk' => 'public']);
                $data += ['thumbnail' => isset($path) && ! empty($path) ? asset($path) : ''];
            }

            $data += [
                'name'               => $this->name,
                'description'        => $this->description,
                'shortDescription'   => $this->shortDescription,
                'amount'             => $this->price,
                'retailAmount'       => $this->rPrice,
                'category'           => $this->category,
                'discountType'       => $this->discountType,
                'discountData'       => $this->discountData,
                'status'             => $this->status,
                'shippingType'       => $this->sameDay,
                'vat'                => $this->vat ? $this->vat : 0,
                'sku'                => $this->sku ?? '',
                'qty'                => $this->onSQty,
                'wQty'               => $this->onWQty,
                'backOrder'          => $this->backOrder,
                'weight'             => $this->weight,
                'length'             => $this->length,
                'width'              => $this->width,
                'height'             => $this->height,
                'metaTagTitle'       => $this->metaTitle,
                'metaTagDescription' => $this->metaDescription,
                'metaTagKeywords'    => json_encode($this->metaTags),
                'hasVendor'          => $hasVendor,
                'hasBrand'           => $this->brand,
                'isFeatured'         => $this->featured,
                'isOffer'            => $this->offered,
                'isUsed'             => $this->used,
                'offerExpireAt'      => $this->offerExpireAt,
                'needAdvance'        => $this->needAdvance,
            ];

            $product = $this->product->update($data);

            if (json_validate($this->metaTags)) {
                $tags = [];

                foreach (json_decode($this->metaTags, true) as $key => $tag) {
                    if (isset($tag['value']) && ! empty($tag['value'])) {
                        $tags[]  = $tag['value'];
                        $existed = ProductTags::where('tag', $tag['value'])->where('productID', $this->product->id)->first();
                        if (! $existed) {
                            ProductTags::create([
                                'tag'       => $tag['value'],
                                'productID' => $this->product->id,
                            ]);
                        }
                    }
                }
                ProductTags::whereNotIn('tag', $tags)->where('productID', $this->product->id)->delete();
            }

            $path = null;

            $assets = $this->assets;

            if ($assets) {
                foreach ($assets as $key => $asset) {
                    $file = $asset;

                    $name = $file->getClientOriginalName();

                    $type = $file->getClientMimeType();

                    $path = $file->storeAs('products', $name, ['disk' => 'public']);

                    ProductAssets::create([
                        'path'      => $path,
                        'type'      => 'assets',
                        'assetType' => $type,
                        'productID' => $this->product->id,
                    ]);

                    $path = null;
                }
            }

            if ($this->variations) {
                $excludedTypes = [];
                foreach ($this->variations as $key => $value) {
                    if (isset($value['thumbnail']) && ! empty($value['thumbnail'])) {
                        $file = $value['thumbnail'];

                        $name = $file->getClientOriginalName();

                        $path = $file->storeAs('products', $name, ['disk' => 'public']);
                    }
                    if (isset($value['id']) && $value['id']) {
                        $variation = ProductVariations::find($value['id']);
                        if ($variation) {
                            if (isset($path)) {
                                $variation->update([
                                    'type'      => $value['type'],
                                    'data'      => $value['data'],
                                    'hasPrice'  => $value['hasPrice'] ?: 0,
                                    'stock'     => $value['stock'] ?: 0,
                                    'thumbnail' => asset($path),
                                    'productID' => $this->product->id,
                                ]);
                            } else {
                                $variation->update([
                                    'type'      => $value['type'],
                                    'data'      => $value['data'],
                                    'hasPrice'  => $value['hasPrice'] ?: 0,
                                    'stock'     => $value['stock'] ?: 0,
                                    'productID' => $this->product->id,
                                ]);
                            }
                        }
                    } else {
                        ProductVariations::create([
                            'type'      => $value['type'],
                            'data'      => $value['data'],
                            'hasPrice'  => $value['hasPrice'] ?: 0,
                            'thumbnail' => isset($path) && ! empty($path) ? asset($path) : '',
                            'productID' => $this->product->id,
                        ]);
                    }

                    $excludedTypes[] = $value['type'];
                }
            }
            if ($this->specification) {
                $excludedSpecs = [];
                if (is_array($this->specification)) {
                    foreach ($this->specification as $key => $specification) {
                        if (isset($specification['data']) && is_array($specification['data'])) {
                            foreach ($specification['data'] as $key => $value) {
                                if (isset($value['id']) && $value['id']) {
                                    $spec = ProductSpecification::find($value['id']);
                                    if ($spec) {
                                        $spec->update([
                                            'title' => $specification['title'],
                                            'key'   => $value['name'],
                                            'value' => $value['value'],
                                        ]);
                                    }
                                } else {
                                    ProductSpecification::create([
                                        'title'     => $specification['title'],
                                        'key'       => $value['name'],
                                        'value'     => $value['value'],
                                        'productID' => $this->product->id,
                                    ]);
                                }
                            }
                        }
                    }
                }
            }
            $this->variations = [];
            foreach (ProductVariations::where('productID', $this->product->id)->get() as $key => $value) {
                $this->variations[] = ['id' => $value['id'], 'type' => $value['type'], 'data' => $value['data'], 'hasPrice' => $value['hasPrice'], 'previewThumbnail' => $value['thumbnail']];
            }
            $specification = [];
            foreach (ProductSpecification::where('productID', $this->product->id)->get() as $key => $value) {
                $specification[$value['title']]['title']  = $value['title'];
                $specification[$value['title']]['data'][] = ['id' => $value['id'], 'name' => $value['key'], 'value' => $value['value']];
            }
            $this->specification = array_values($specification);
            $this->dispatch('on-clear');
            $this->dispatch('pro-notification', type: 'success', title: 'Product Updated Successfully', message: 'The product has been successfully updated. 🎉');
        }
    }

    public function saveProduct()
    {
        $this->dispatch('hide-loader');

        $this->validate();

        $hasVendor = $this->hasVendor();

        if ($this->thumbnail) {
            $this->validate(['thumbnail' => 'image|max:1024'], ['thumbnail' => 'Please add a category thumbnail']);
            $file = $this->thumbnail;

            $name = $file->getClientOriginalName();

            $path = $file->storeAs('products', $name, ['disk' => 'public']);
        }

        $sku = $this->sku;
        if ($hasVendor && $this->category) {
            $ven = Vendors::find($hasVendor);
            $cat = Categories::find($this->category);
            if ($ven && $cat) {
                $sku = $this->initials($ven->company, 3) . '-' . $this->initials($cat->name, 3) . '-' . rand(15525222, 84445526);
            }
        }

        $product = Products::create([
            'name'               => $this->name,
            'description'        => $this->description,
            'shortDescription'   => $this->shortDescription,
            'amount'             => $this->price,
            'retailAmount'       => $this->rPrice,
            'thumbnail'          => isset($path) && ! empty($path) ? asset($path) : '',
            'category'           => $this->category,
            'discountType'       => $this->discountType,
            'discountData'       => $this->discountData,
            'status'             => $this->status,
            'shippingType'       => $this->sameDay,
            'vat'                => $this->vat ? $this->vat : 0,
            'sku'                => $sku ?? '',
            'qty'                => $this->onSQty,
            'wQty'               => $this->onWQty,
            'backOrder'          => $this->backOrder,
            'weight'             => $this->weight,
            'length'             => $this->length,
            'width'              => $this->width,
            'height'             => $this->height,
            'metaTagTitle'       => $this->metaTitle,
            'metaTagDescription' => $this->metaDescription,
            'metaTagKeywords'    => json_encode($this->metaTags),
            'hasVendor'          => $hasVendor,
            'hasBrand'           => $this->brand,
            'isFeatured'         => $this->featured,
            'isOffer'            => $this->offered,
            'isUsed'             => $this->used,
            'offerExpireAt'      => $this->offerExpireAt,
            'needAdvance'        => $this->needAdvance,
        ]);

        if (is_array($this->metaTags)) {
            $tags = [];
            foreach ($this->metaTags as $key => $tag) {
                if (isset($tag['value']) && ! empty($tag['value'])) {
                    ProductTags::create([
                        'tag'       => $tag['value'],
                        'productID' => $product->id,
                    ]);
                }
            }
            ProductTags::whereNotIn('tag', $tags)->where('productID', $product->id)->delete();
        }

        $path = null;

        $assets = $this->assets;

        if ($assets) {
            foreach ($assets as $key => $asset) {
                $file = $asset;

                $name = $file->getClientOriginalName();

                $type = $file->getClientMimeType();

                $path = $file->storeAs('products', $name, ['disk' => 'public']);

                ProductAssets::create([
                    'path'      => $path,
                    'type'      => 'assets',
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
                    'type'      => $value['type'],
                    'data'      => $value['data'],
                    'hasPrice'  => $value['hasPrice'] ?: 0,
                    'stock'     => $value['stock'] ?: 0,
                    'thumbnail' => isset($path) && ! empty($path) ? asset($path) : '',
                    'productID' => $product->id,
                ]);
            }
        }

        if ($this->specification) {
            if (is_array($this->specification)) {
                foreach ($this->specification as $key => $specification) {
                    if (isset($specification['data']) && is_array($specification['data'])) {
                        foreach ($specification['data'] as $key => $value) {
                            ProductSpecification::create([
                                'title'     => $specification['title'],
                                'key'       => $value['name'],
                                'value'     => $value['value'],
                                'productID' => $product->id,
                            ]);
                        }
                    }
                }
            }
        }

        $this->dispatch('pro-notification', type: 'success', title: 'Product Saved Successfully', message: 'The product has been successfully saved. 🎉');

        $this->clear();

        $this->redirect(route('admin.product.add'));
    }

    public function deleteThumb()
    {
        if ($this->product) {
            $data = [
                'thumbnail' => null,
            ];
            $this->product->update($data);
        }
        $this->showThumbnail = false;
        $this->dispatch('on-clear');
        $this->dispatch('refreshDatatable');
    }

    public function deleteVThumb($index)
    {
        if (isset($this->variations[$index]['id'])) {
            $vars = ProductVariations::where('id', $this->variations[$index]['id'])->first();
            if ($vars) {
                $data = [
                    'thumbnail' => null,
                ];
                $vars->update($data);
                unset($this->variations[$index]['previewThumbnail']);
            }
        }
    }

    public function clear()
    {
        $this->name            = '';
        $this->description     = '';
        $this->price           = 0;
        $this->rPrice          = 0;
        $this->thumbnail       = '';
        $this->showThumbnail   = '';
        $this->category        = null;
        $this->discountType    = 0;
        $this->discountData    = null;
        $this->status          = '';
        $this->sameDay         = 0;
        $this->vat             = 0;
        $this->sku             = null;
        $this->onSQty          = 0;
        $this->onWQty          = 0;
        $this->backOrder       = 0;
        $this->weight          = 0;
        $this->length          = 0;
        $this->width           = 0;
        $this->height          = 0;
        $this->featured        = 0;
        $this->needAdvance     = 0;
        $this->brand           = null;
        $this->metaTitle       = null;
        $this->metaDescription = null;
        $this->metaTags        = null;
        $this->offerExpireAt   = null;
        $this->assets          = [];
        $this->variations      = [['type' => '', 'data' => '', 'hasPrice' => '', 'thumbnail' => '']];
        $this->dispatch('on-clear');
        $this->vendor = [];
    }

    #[Renderless]
    public function searchVen($searchVendor)
    {
        $vendors    = Vendors::where('company', 'LIKE', '%' . $searchVendor . '%')->orWhere('name', 'LIKE', '%' . $searchVendor . '%')->orWhere('phone', 'LIKE', '%' . $searchVendor . '%')->orderBy('id', 'DESC')->get();
        $searchData = [];
        foreach ($vendors as $key => $value) {
            $searchData[] = $value;
        }

        return $searchData;
    }

    public function render()
    {
        return view('livewire.admin.product.add-product')->extends('admin.layout.master', ['title' => $this->title, 'breadCrumb' => $this->breadCrumb])->section('content');
    }
}
