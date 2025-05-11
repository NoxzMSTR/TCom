<?php
namespace App\Livewire\Public;

use App\Models\Order\Orders;
use Livewire\Component;

class CheckoutSuccess extends Component
{
    public $title      = 'Order Summary';
    public $breadCrumb = 'Home.Order.Summary';
    public $order;
    public $type = 'track';

    public function mount($trackingNo)
    {
        $this->order = Orders::with(['items.product'])->whereRaw('REPLACE(trackingNo, "-", "") = ?', [str_replace('-', '', $trackingNo)])->latest()->first();

        if (request('type')) {
            $this->type = request('type');
        }
        if ($this->type == 'success') {
            $this->title = 'Order has been confirmed!';
        }
        if (! $this->order) {
            $this->title = 'Order Not Found';
        }
    }

    public function render()
    {
        return view('livewire.public.checkout-success')->extends('layout.public-master', ['title' => $this->title, 'breadCrumb' => $this->breadCrumb])->section('content');
    }
}
