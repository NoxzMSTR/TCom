<?php
namespace App\Livewire\Public;

use App\Mail\Order\OrderPlaced;
use App\Models\Order\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class CheckoutSuccess extends Component
{
    public $title      = 'Order Summary';
    public $breadCrumb = 'Home.Order.Summary';
    public $order;
    public $type = 'track';

    public function mount($trackingNo)
    {
        if ($trackingNo == 'failed') {
            $this->title = 'Ops something went wrong!';
        } else {
            $this->order = Orders::with(['items.product'])->whereRaw('REPLACE(trackingNo, "-", "") = ?', [str_replace('-', '', $trackingNo)])->latest()->first();

            if (request('type')) {
                $this->type = request('type');
            }
            if ($this->type == 'success') {
                $this->title = 'Order has been confirmed!';
            }
            if ($this->type == 'paid') {
                $this->title = 'Order has been paid & confirmed!';
            }
            if ($this->type == 'advance') {
                $this->title = 'Order has received advance payment & confirmed!';
            }
            if (! $this->order) {
                $this->title = 'Order Not Found';
            }
        }

    }

    public function before($orderNo, Request $request)
    {
        $order = Orders::with(['items.product'])->where('orderNo', $orderNo)->latest()->first();

        $type = 'success';

        if ($order) {
            if ($order->paymentMethod == 'credit') {
                $type = 'paid';
                $order->update([
                    'isPaid' => true,
                ]);
            } elseif ($order->paymentMethod == 'advance') {
                $type                = 'advance';
                $shippingCharges     = 0;
                $shippingChargeLimit = 0;
                $advanceAmount       = 0;
                if (defined('order_settings')) {
                    foreach (order_settings as $key => $value) {
                        if ($value['type'] == 'advance_payment') {
                            $amount        = json_validate($value['data']) ? json_decode($value['data'], true) : [];
                            $advanceAmount = $amount;
                        }
                        if ($value['type'] == 'shipping_charges') {
                            $charge          = json_validate($value['data']) ? json_decode($value['data'], true) : [];
                            $shippingCharges = $charge;
                        }
                        if ($value['type'] == 'shipping_charge_limit') {
                            $chargeLimit         = json_validate($value['data']) ? json_decode($value['data'], true) : [];
                            $shippingChargeLimit = $chargeLimit;
                        }
                    }
                }

                $total = 0;

                foreach ($order->items as $key => $exProduct) {
                    $qty      = $exProduct['qty'];
                    $discount = $exProduct['amount'];

                    $total += $discount * $qty;
                }

                if ($shippingCharges && $total < $shippingChargeLimit) {
                    $shippingCharges = 0;
                }

                $total = $advanceAmount + $shippingCharges;

                $order->update([
                    'isAdvancePaid' => true,
                    'advance'       => $total,
                ]);
            }

            try {
                Mail::to($order->userEmail)->send(new OrderPlaced('Order is Being Processed #' . $order->invoiceNo, $order));
            } catch (\Throwable $th) {

            }

            forgetSharedProperties(['add-to-cart']);

        } else {
            $type = 'failed';
        }

        return redirect()->route('public.checkout.success', [$order->trackingNo, 'type' => $type]);
    }

    public function render()
    {
        return view('livewire.public.checkout-success')->extends('layout.public-master', ['title' => $this->title, 'breadCrumb' => $this->breadCrumb])->section('content');
    }
}
