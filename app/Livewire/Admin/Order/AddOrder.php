<?php
namespace App\Livewire\Admin\Order;

use App\Models\Buyers;
use App\Models\Order\OrderItems;
use App\Models\Order\Orders;
use App\Models\Product\Products;
use App\Models\Product\ProductVariations;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Monarobase\CountryList\CountryListFacade;

class AddOrder extends Component
{
    public $title = 'Add Order';

    public $breadCrumb = 'Home.Order.Add';

    public $orderNo = 1000000;

    #[Validate('required', message: 'Please select order date')]
    public $orderDate;

    #[Validate('required', message: 'Please select payment method')]
    public $paymentMethod;

    #[Validate('required', message: 'Please select paid status')]
    public $paidStatus = 0;

    #[Validate('required', message: 'Please select status')]
    public $status;

    public $search;

    public $productData;

    #[Validate([
            'products'          => 'required',
            'products.*.name'   => [
                'required',
                'min:3',
            ],
            'products.*.qty'    => [
                'required',
                'numeric',
            ],
            'products.*.amount' => [
                'required',
                'numeric',
            ],
        ], message: [
            'products.*.name.required'   => 'Product name is required.',
            'products.*.name.min'        => 'Transaction for is too short.',
            'products.*.qty.required'    => 'Product qty is required.',
            'products.*.qty.numeric'     => 'Product qty must be a numeric value.',
            'products.*.amount.required' => 'Product price is required.',
            'products.*.amount.numeric'  => 'Product price must be a numeric value.',
        ])]
    public $products = [];

    public $shippingSameAsBilling = 1;

    #[Validate('required', message: 'Please enter billing address')]
    public $billingAddress;

    public $billingAddress2;

    #[Validate('required', message: 'Please enter billing city')]
    public $billingCity;

    #[Validate('required', message: 'Please enter billing postcode')]
    public $billingPostcode;

    #[Validate('required', message: 'Please enter billing state')]
    public $billingState;

    #[Validate('required', message: 'Please enter billing country')]
    public $billingCountry;

    #[Validate('required', message: 'Please enter shipping address')]
    public $shippingAddress;

    public $shippingAddress2;

    #[Validate('required', message: 'Please enter shipping address')]
    public $shippingCity;

    #[Validate('required', message: 'Please enter shipping address')]
    public $shippingPostcode;

    #[Validate('required', message: 'Please enter shipping address')]
    public $shippingState;

    #[Validate('required', message: 'Please senter shipping address')]
    public $shippingCountry;

    #[Validate('required', message: 'Please enter buyer first name')]
    public $buyerFirstName;

    public $buyerLastName;

    #[Validate('required', message: 'Please enter buyer email')]
    public $buyerEmail;

    #[Validate('required', message: 'Please enter buyer phone')]
    public $buyerPhone;

    #[Validate('required', message: 'Please select buyer type')]
    public $buyerType = 0;

    public $buyer;

    public $order;

    public function mount($orderID = null)
    {
        $this->orderDate = now()->format('Y-m-d');

        if ($orderID) {
            $this->title      = 'Update Order';
            $this->breadCrumb = 'Home.Order.Update';
            $this->order      = Orders::with(['buyer'])->find($orderID);

            if ($this->order) {
                $order                       = $this->order;
                $this->buyer                 = $order->buyer;
                $this->orderNo               = $order->orderNo;
                $this->status                = $order->status;
                $this->paymentMethod         = $order->paymentMethod;
                $this->orderDate             = $order->orderDate;
                $this->buyerType             = $order->userRole;
                $this->buyerEmail            = $order->userEmail;
                $this->buyerFirstName        = $order->userFirstName;
                $this->buyerLastName         = $order->userLastName;
                $this->buyerPhone            = $order->userPhone;
                $this->shippingAddress       = $order->shippingAddress;
                $this->shippingAddress2      = $order->shippingAddress2;
                $this->shippingCity          = $order->shippingCity;
                $this->shippingState         = $order->shippingRegion;
                $this->shippingCountry       = $order->shippingCountry;
                $this->shippingPostcode      = $order->shippingPostalCode;
                $this->shippingSameAsBilling = $order->shippingSameAsBilling;
                $this->billingAddress        = $order->deliveryAddress;
                $this->billingAddress2       = $order->deliveryAddress2;
                $this->billingCity           = $order->deliveryCity;
                $this->billingCountry        = $order->deliveryCountry;
                $this->billingState          = $order->deliveryRegion;
                $this->billingPostcode       = $order->deliveryPostalCode;

                foreach ($order->items()->with(['product'])->get()->toArray() as $key => $value) {
                    if (isset($value['product'])) {

                        $product = $value['product'];

                        $product['amount'] = $value['amount'];

                        $product['actualAmount'] = $value['product']['amount'];

                        $product['qty'] = $value['qty'];

                        $product['sameDate'] = $value['sameDate'];

                        $product['sameDaySlot'] = $value['sameDaySlot'];

                        $product['variationData'] = $value['variationData'];

                        $this->setProduct($product);
                    }
                }
            }
        }
    }

    public function boot()
    {
        $this->setOrderOn();
    }

    #[Computed]
    public function country()
    {
        return CountryListFacade::getOne('PK', 'en');
    }

    public function setOrderOn()
    {
        if (! $this->order) {
            $count = Orders::count();

            $this->orderNo = $this->orderNo + $count;
        }
    }

    public function setProduct($product)
    {
        $variations = ProductVariations::where('productID', $product['id'])->get()->toArray();

        $product += ['variations' => $variations];

        $this->products[] = $product;

        $this->search = null;
    }

    public function deleteProduct($index)
    {
        if (isset($this->products[$index])) {
            if (isset($this->products[$index]['id']) && $this->order) {
                OrderItems::where('productID', $this->products[$index]['id'])->where('orderID', $this->order->id)->delete();
            }
            unset($this->products[$index]);
        }
        $products = [];

        foreach ($this->products as $key => $value) {
            $products[] = $value;
        }

        $this->products = $products;
    }

    public function hasBuyer()
    {
        $buyer = 0;

        if ($this->buyer) {
            $buyer = $this->buyer->id;
        } else {
            $buyer = Buyers::create([
                'type'      => $this->buyerType,
                'firstName' => $this->buyerFirstName,
                'lastName'  => $this->buyerLastName,
                'email'     => $this->buyerEmail,
                'phone'     => $this->buyerPhone,
            ]);
            $buyer = $buyer->id;
        }

        return $buyer;
    }

    public function addOrder()
    {

        $this->validate();

        $buyerID = $this->hasBuyer();

        $total = 0;

        $order = Orders::create([
            'orderNo'               => $this->orderNo,
            'orderDate'             => $this->orderDate,
            'invoiceNo'             => 'INV-' . $this->orderNo,
            'invoicePath'           => '',
            'paymentMethod'         => $this->paymentMethod,
            'userRole'              => $this->buyerType,
            'userID'                => $buyerID,
            'userFirstName'         => $this->buyerFirstName,
            'userLastName'          => $this->buyerLastName,
            'userEmail'             => $this->buyerEmail,
            'userPhone'             => $this->buyerPhone,
            'shippingPostalCode'    => $this->shippingPostcode,
            'shippingAddress'       => $this->shippingAddress,
            'shippingCity'          => $this->shippingCity,
            'shippingRegion'        => $this->shippingState,
            'shippingCountry'       => $this->shippingCountry,
            'deliveryPostalCode'    => $this->billingPostcode,
            'deliveryAddress'       => $this->billingAddress,
            'deliveryCity'          => $this->billingCity,
            'deliveryRegion'        => $this->billingState,
            'deliveryCountry'       => $this->billingCountry,
            'isPaid'                => $this->paidStatus,
            'shippingSameAsBilling' => $this->shippingSameAsBilling,
            'status'                => $this->status,
            'bookerID'              => Auth::id(),
        ]);

        foreach ($this->products as $key => $product) {

            $vars = [];

            foreach ($product['selectedVars'] as $type => $id) {
                $hasVar      = ProductVariations::find($id);
                $vars[$type] = $hasVar ? $hasVar : [];
            }

            OrderItems::create([
                'orderID'       => $order->id,
                'productID'     => $product['id'],
                'name'          => $product['name'],
                'amount'        => $product['amount'],
                'qty'           => $product['qty'],
                'discountType'  => $product['discountType'],
                'discountData'  => $product['discountData'],
                'variationData' => json_encode($vars),
            ]);
        }

        $this->clear();
    }

    public function updateOrder()
    {
        $this->validate();

        $buyerID = $this->hasBuyer();

        $total = 0;

        $order = $this->order->update([
            'orderNo'               => $this->orderNo,
            'orderDate'             => $this->orderDate,
            'invoiceNo'             => 'INV-' . $this->orderNo,
            'invoicePath'           => '',
            'paymentMethod'         => $this->paymentMethod,
            'userRole'              => $this->buyerType,
            'userID'                => $buyerID,
            'userFirstName'         => $this->buyerFirstName,
            'userLastName'          => $this->buyerLastName,
            'userEmail'             => $this->buyerEmail,
            'userPhone'             => $this->buyerPhone,
            'shippingPostalCode'    => $this->shippingPostcode,
            'shippingAddress'       => $this->shippingAddress,
            'shippingCity'          => $this->shippingCity,
            'shippingRegion'        => $this->shippingState,
            'shippingCountry'       => $this->shippingCountry,
            'deliveryPostalCode'    => $this->billingPostcode,
            'deliveryAddress'       => $this->billingAddress,
            'deliveryCity'          => $this->billingCity,
            'deliveryRegion'        => $this->billingState,
            'deliveryCountry'       => $this->billingCountry,
            'isPaid'                => $this->paidStatus,
            'shippingSameAsBilling' => $this->shippingSameAsBilling,
            'status'                => $this->status,
        ]);

        foreach ($this->products as $key => $product) {

            $items = OrderItems::where('orderID', $this->order->id)->where('productID', $product['id'])->first();
            if ($items) {
                $vars = [];

                foreach ($product['selectedVars'] as $type => $id) {
                    $hasVar      = ProductVariations::find($id);
                    $vars[$type] = $hasVar ? $hasVar : [];
                }

                $items->update([
                    'amount'        => $product['amount'],
                    'qty'           => $product['qty'],
                    'discountType'  => $product['discountType'],
                    'discountData'  => $product['discountData'],
                    'variationData' => json_encode($vars),
                ]);
            }
        }
    }

    public function setShippingData()
    {
        if ($this->shippingSameAsBilling) {
            $this->shippingAddress  = $this->billingAddress;
            $this->shippingAddress2 = $this->billingAddress2;
            $this->shippingCity     = $this->billingCity;
            $this->shippingState    = $this->billingState;
            $this->shippingCountry  = $this->billingCountry;
            $this->shippingPostcode = $this->billingPostcode;
        } else {
            $this->shippingAddress  = null;
            $this->shippingAddress2 = null;
            $this->shippingCity     = null;
            $this->shippingState    = null;
            $this->shippingCountry  = null;
            $this->shippingPostcode = null;
        }
    }

    public function updated($property)
    {
        if ($property == 'search') {

            if ($this->search) {
                $this->productData = Products::where('description', 'LIKE', '%' . $this->search . '%')->orWhere('name', 'LIKE', '%' . $this->search . '%')->orWhere('id', 'LIKE', '%' . $this->search . '%');
            } else {
                $this->search = null;
            }
        }
        if ($property == 'shippingSameAsBilling') {
            $this->setShippingData();
        }
    }

    #[Computed]
    public function searchData()
    {
        $searchData = [];
        if ($this->productData) {
            $this->productData = $this->productData->orderBy('id', 'DESC')->get();
            foreach ($this->productData as $key => $value) {
                $searchData[] = $value;
            }
        }
        return $searchData;
    }

    public function clear()
    {
        $this->status                = 0;
        $this->paymentMethod         = null;
        $this->orderDate             = null;
        $this->buyerType             = 0;
        $this->buyerEmail            = null;
        $this->buyerFirstName        = null;
        $this->buyerLastName         = null;
        $this->buyerPhone            = null;
        $this->shippingAddress       = null;
        $this->shippingAddress2      = null;
        $this->shippingCity          = null;
        $this->shippingCountry       = null;
        $this->shippingPostcode      = null;
        $this->shippingSameAsBilling = 1;
        $this->billingAddress        = null;
        $this->billingAddress2       = null;
        $this->billingCity           = null;
        $this->billingCountry        = null;
        $this->billingState          = null;
        $this->billingPostcode       = null;
        $this->productData           = null;
        $this->search                = null;
        $this->products              = [];
    }

    public function render()
    {
        return view('livewire.admin.order.add-order')->extends('admin.layout.master', ['title' => $this->title, 'breadCrumb' => $this->breadCrumb])->section('content');
    }
}
