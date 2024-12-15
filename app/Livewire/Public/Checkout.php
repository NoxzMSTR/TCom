<?php

namespace App\Livewire\Public;

use App\Models\Buyers;
use Livewire\Component;
use App\Models\Order\Orders;
use App\Models\Order\OrderItems;
use Livewire\Attributes\Validate;

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
        'billing.country' => [
            'required'
        ],
        'billing.address' => [
            'required'
        ],
        'billing.city' => [
            'required'
        ],
        'billing.postcode' => [
            'required'
        ],
        'billing.state' => [
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
    public $shippingdiffrentAddress = 0;
    public $note;


    public function mount()
    {
        $products = getSharedProperty('add-to-cart');

        if ($products == null) {
            $products = [];
        }

        $default_currency = default_currency;

        if (is_array($products)) {

            $totalAmount = 0;

            $exProduct = [];

            foreach ($products as $key => $product) {
                $exProduct[$product->id][] = $product;
                if (isset($default_currency)) {
                    $discount = 0;
                    $amount = $product->amount;
                    if ($product->discountType == 1) {
                        $discount =
                            ($amount / 100) * $product->discountData;
                        $totalAmount +=  $discount = $amount - $discount;
                    } elseif ($product->discountType == 2) {
                        $totalAmount += $discount = $product->discountData;
                    }
                } else {
                    $discount = $product->amount;
                }
            }

            $this->products = $exProduct;

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
                'shipping.country' => [
                    'required'
                ],
                'shipping.address' => [
                    'required'
                ],
                'shipping.city' => [
                    'required'
                ],
                'shipping.postcode' => [
                    'required'
                ],
                'shipping.state' => [
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
            'shippingPostalCode' => $this->shippingdiffrentAddress ? $this->shipping['postcode'] : $this->billing['postcode'],
            'shippingAddress' => $this->shippingdiffrentAddress ? $this->shipping['address'] : $this->billing['address'],
            'shippingCity' => $this->shippingdiffrentAddress ? $this->shipping['city'] : $this->billing['city'],
            'shippingRegion' => $this->shippingdiffrentAddress ? $this->shipping['state'] : $this->billing['state'],
            'shippingCountry' => $this->shippingdiffrentAddress ? $this->shipping['country'] : $this->billing['country'],
            'deliveryPostalCode' => $this->billing['postcode'],
            'deliveryAddress' => $this->billing['address'],
            'deliveryCity' => $this->billing['city'],
            'deliveryRegion' => $this->billing['state'],
            'deliveryCountry' => $this->billing['country'],
            'isPaid' => 0,
            'shippingSameAsBilling' => $this->shippingdiffrentAddress,
            'status' => 0,
            'bookerID' => 0,
            'notes' => $this->note,
        ]);

        foreach ($this->products as $key => $product) {
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

        return redirect()->route('public.checkout.success', [$order->trackingNo, 'type' => 'success']);
    }

    public function render()
    {
        return view('livewire.public.checkout')->extends('layout.public-master', ['title' => $this->title, 'breadCrumb' => $this->breadCrumb])->section('content');
    }
}
