<?php

namespace App\Livewire\Public;

use App\Models\Buyers;
use Livewire\Component;
use App\Models\Order\Orders;
use App\Models\Order\OrderItems;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\DB;
use Aaqib\GeoPakistan\Models\District;
use Illuminate\Validation\ValidationException;
use Stevebauman\Location\Facades\Location;

class Checkout extends Component
{
    public $title = 'Checkout';
    public $breadCrumb = 'Home.Checkout';
    public $products = [];
    public $totalAmount = 0;
    #[Validate([
        'billing.name' => [
            'required',
            'min:3'
        ],

        'billing.address' => [
            'required'
        ],
        'billing.city' => [
            'required'
        ],

        'billing.email' => [
            'required',
            'email',
        ],
        'billing.phone' => [
            'required',
        ],
    ], message: [
        'billing.name.required' => 'Billing name is required.',
        'billing.country.required' => 'Billing country is required.',
        'billing.address.required' => 'Billing address is required.',
        'billing.city.required' => 'Billing city is required.',
        'billing.postcode.required' => 'Billing postcode is required.',
        'billing.state.required' => 'Billing state is required.',
        'billing.email.required' => 'Billing email is required.',
        'billing.phone.required' => 'Billing phone is required.',
    ])]
    public $billing = [];

    public $shipping = [];
    public $sameDayProducts = [];
    public $slots = [];
    public $hasSlots = [];

    public $shippingdiffrentAddress = 0;

    #[Validate('required', message: 'Please make that you agreed to our terms & conditions')]
    public $termCondtions;
    public $note;
    public $userIP;


    public function mount()
    {
        $products = getSharedProperty('add-to-cart');

        if ($products == null) {
            $products = [];
        }

        $default_currency = default_currency;

        if (is_array($products)) {
            $totalAmount = 0;
            $exProducts = [];
            foreach ($products as $key => $vars) {
                $exProducts[$vars['product']->id] = 1;
                $totalAmount += $vars['final'];
            }
            $this->products = $products;
            $this->totalAmount = currency_format(
                $totalAmount,
                $default_currency,
            );
        }
    }

    public function validateShipping()
    {
        if ($this->shippingdiffrentAddress) {
            $this->validate([
                'shipping.name' => [
                    'required',
                    'min:3'
                ],

                'shipping.address' => [
                    'required'
                ],
                'shipping.city' => [
                    'required'
                ],

                'shipping.email' => [
                    'required',
                    'email',
                ],
                'shipping.phone' => [
                    'required',
                ],
            ], [
                'shipping.name.required' => 'Shipping name is required.',
                'shipping.country.required' => 'Shipping country is required.',
                'shipping.address.required' => 'Shipping address is required.',
                'shipping.city.required' => 'Shipping city is required.',
                'shipping.postcode.required' => 'Shipping postcode is required.',
                'shipping.state.required' => 'Shipping state is required.',
                'shipping.email.required' => 'Shipping email is required.',
                'shipping.phone.required' => 'Shipping phone is required.',
            ]);
        }
    }

    public function hasBuyer()
    {
        $buyer = 0;
        $hasBuyer = Buyers::where('email', $this->billing['email'])->first();
        if ($hasBuyer) {
            $buyer = $hasBuyer->id;
        } else {
            $buyer = Buyers::create([
                'type' => 0,
                'firstName' => $this->billing['name'],
                'lastName' => '',
                'email' => $this->billing['email'],
                'phone' => $this->billing['phone'],
            ]);
            $buyer = $buyer->id;
        }

        return $buyer;
    }

    public function placeOrder()
    {
        $this->validate();

        $this->validateShipping();

        if (count($this->hasSlots) !== count($this->slots)) {
            throw ValidationException::withMessages(['hasSlots' => 'Please select slots to proceed with order!']);
        }

        $billing = DB::table('pakistan_districts')->select(['pakistan_districts.name as city', 'pakistan_provinces.name as state'])->join('pakistan_provinces', 'pakistan_districts.province_id', '=', 'pakistan_provinces.id')->where('pakistan_districts.name', $this->billing['city'])->first();
        if ($this->shippingdiffrentAddress) {
            $shipping = DB::table('pakistan_districts')->select(['pakistan_districts.name as city', 'pakistan_provinces.name as state'])->join('pakistan_provinces', 'pakistan_districts.province_id', '=', 'pakistan_provinces.id')->where('pakistan_districts.name', $this->shipping['city'])->first();
        }
        try {
            $location = getCountry($this->userIP);
        } catch (\Throwable $th) {
            //throw $th;
        }

        $country = isset($location['country']) ? $location['country'] : 'Pakistan';
        $postalCode = isset($location['zip']) ? $location['zip'] : '0';

        $buyerID =  $this->hasBuyer();

        $count = Orders::count();

        $orderNo = 1000000;

        $orderNo = $orderNo + $count;

        $order = Orders::create([
            'orderNo' => $orderNo,
            'orderDate' => now()->format('Y-m-d'),
            'invoiceNo' => 'INV-' . $orderNo,
            'invoicePath' => '',
            'paymentMethod' => 'cod',
            'userRole' => 0,
            'userID' => $buyerID,
            'userFirstName' => $this->billing['name'],
            'userLastName' => '',
            'userEmail' => $this->billing['email'],
            'userPhone' => $this->billing['phone'],
            'shippingPostalCode' => $this->shippingdiffrentAddress ? $postalCode : $postalCode,
            'shippingAddress' => $this->shippingdiffrentAddress ? $this->shipping['address'] : $this->billing['address'],
            'shippingCity' => $this->shippingdiffrentAddress ? $this->shipping['city'] : $this->billing['city'],
            'shippingRegion' => $this->shippingdiffrentAddress ? $shipping->state : $billing->state,
            'shippingCountry' => $this->shippingdiffrentAddress ? $country : $country,
            'deliveryPostalCode' => $postalCode,
            'deliveryAddress' => $this->billing['address'],
            'deliveryCity' => $this->billing['city'],
            'deliveryRegion' => $billing->state,
            'deliveryCountry' => $country,
            'isPaid' => 0,
            'shippingSameAsBilling' => $this->shippingdiffrentAddress,
            'status' => 0,
            'bookerID' => 0,
            'notes' => $this->note,
        ]);

        $sameData = [];
        $productsByCType = [];

        foreach ($this->slots as $key => $value) {
            $data = explode('_', $value);
            if (isset($data[2])) {
                $sameData[$data[0]] = ['city' => $data[0], 'date' => $data[1], 'slot' => $data[2]];
            }
        }

        foreach ($this->products as $key => $exProduct) {
            $product = $exProduct['product'];
            if ($product->vendor) {
                $city = $product->vendor->city;
            }
            $qty = $exProduct['qty'];
            $discount = $exProduct['final'];
            $variations = $exProduct['variations'];
            if ($product->shippingType == 1 && isset($city)) {
                OrderItems::create([
                    'orderID' => $order->id,
                    'productID' => $product->id,
                    'name' => $product->name,
                    'amount' => $discount,
                    'qty' => $qty,
                    'discountType' => $product->discountType,
                    'discountData' => $product->discountData,
                    'from' => isset($sameData[$city]) ? $sameData[$city]['city'] : '',
                    'sameDate' => isset($sameData[$city]) ? $sameData[$city]['date'] : '',
                    'sameDaySlot' => isset($sameData[$city]) ? $sameData[$city]['slot'] : '',
                    'variationData' => json_encode($variations),
                ]);
            } else {
                OrderItems::create([
                    'orderID' => $order->id,
                    'productID' => $product->id,
                    'name' => $product->name,
                    'amount' => $discount,
                    'qty' => $qty,
                    'discountType' => $product->discountType,
                    'discountData' => $product->discountData,
                    'variationData' => json_encode($variations),
                ]);
            }
        }


        foreach ($productsByCType as $city => $nProducts) {
            if ($city !== 0) {
                foreach ($nProducts as $key => $product) {
                    $qty = count($product);
                    $product = $product[0];
                    $discount = $product->amount;

                    $discount = 0;
                    $amount = $product->amount;
                    if ($product->discountType == 1) {
                        $discount =
                            ($amount / 100) * $product->discountData;
                        $discount = $amount - $discount;
                    } elseif ($product->discountType == 2) {
                        $discount = $product->discountData;
                    } else {
                        $discount = $product->amount;
                    }
                    if ($product->shippingType == 1) {
                        OrderItems::create([
                            'orderID' => $order->id,
                            'productID' => $product->id,
                            'name' => $product->name,
                            'amount' => $discount,
                            'qty' => $qty,
                            'discountType' => $product->discountType,
                            'discountData' => $product->discountData,
                            'from' => isset($sameData[$city]) ? $sameData[$city]['city'] : '',
                            'sameDate' => isset($sameData[$city]) ? $sameData[$city]['date'] : '',
                            'sameDaySlot' => isset($sameData[$city]) ? $sameData[$city]['slot'] : '',
                            'variationID' => isset($product->variationID) ? $product->variationID : 0,
                        ]);
                    } else {
                        OrderItems::create([
                            'orderID' => $order->id,
                            'productID' => $product->id,
                            'name' => $product->name,
                            'amount' => $discount,
                            'qty' => $qty,
                            'discountType' => $product->discountType,
                            'discountData' => $product->discountData,
                            'variationID' => isset($product->variationID) ? $product->variationID : 0,
                        ]);
                    }
                }
            } else {
                $qty = count($product);
                $product = $product[0];
                $discount = $product->amount;

                $discount = 0;
                $amount = $product->amount;
                if ($product->discountType == 1) {
                    $discount =
                        ($amount / 100) * $product->discountData;
                    $discount = $amount - $discount;
                } elseif ($product->discountType == 2) {
                    $discount = $product->discountData;
                } else {
                    $discount = $product->amount;
                }

                OrderItems::create([
                    'orderID' => $order->id,
                    'productID' => $product->id,
                    'name' => $product->name,
                    'amount' => $discount,
                    'qty' => $qty,
                    'discountType' => $product->discountType,
                    'discountData' => $product->discountData,
                    'variationID' => isset($product->variationID) ? $product->variationID : 0,
                ]);
            }
        }

        forgetSharedProperties(['add-to-cart']);

        return redirect()->route('public.checkout.success', [$order->trackingNo, 'type' => 'success']);
    }

    public function render()
    {
        return view('livewire.public.checkout')->extends('layout.public-master', ['title' => $this->title, 'breadCrumb' => $this->breadCrumb])->section('content');
    }
}
