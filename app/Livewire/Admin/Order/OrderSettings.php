<?php
namespace App\Livewire\Admin\Order;

use App\Models\Order\OrderSettings as oSettings;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Component;

class OrderSettings extends Component
{
    public $title = 'Order Settings';

    public $breadCrumb = 'Home.Order.Settings';

    public $defaultCurrency = 'PKR';

    public $availableCities = [];

    public $deliveryOn = [];

    public $deliveryTime = [];

    public $sameDayDelivery = [];

    public $standardDelivery;

    public $advanceAmount = 0;

    public $advanceAmountLimit = 0;

    public $shippingCharges = 0;

    public $shippingChargeLimit = 0;

    public $sUrl;

    public $sClientID;

    public $sSecret;

    public function boot()
    {
        $settings           = oSettings::all();
        $hasSameDayDelivery = false;
        foreach ($settings as $key => $value) {
            if ($value->type == 'default_currency') {
                $currency = json_validate($value['data']) ? json_decode($value['data'], true) : [];
                if (isset($currency[0])) {
                    $this->defaultCurrency = $currency[0];
                }
            }

            if ($value->type == 'available_for') {
                $availableCities = json_validate($value['data']) ? json_decode($value['data'], true) : [];
                if (isset($availableCities)) {
                    $this->availableCities = [];
                    $this->availableCities = $availableCities;
                }
            }

            if ($value->type == 'same_day_delivery') {
                $sameDayDelivery = json_validate($value['data']) ? json_decode($value['data'], true) : [];
                if (isset($sameDayDelivery)) {
                    $this->sameDayDelivery = [];
                    $this->sameDayDelivery = $sameDayDelivery;
                }
                $hasSameDayDelivery = true;
            }

            if ($value->type == 'delivery_time') {
                $deliveryTime = json_validate($value['data']) ? json_decode($value['data'], true) : [];
                if (isset($deliveryTime)) {
                    $this->deliveryTime = [];
                    $this->deliveryTime = $deliveryTime;
                }
            }

            if ($value->type == 'delivery_on') {
                $deliveryOn = json_validate($value['data']) ? json_decode($value['data'], true) : [];
                if (isset($deliveryOn)) {
                    $this->deliveryOn = [];
                    $this->deliveryOn = $deliveryOn;
                }
            }
            if ($value->type == 'standard_delivery') {
                $standardDelivery = json_validate($value['data']) ? json_decode($value['data'], true) : [];
                if (isset($standardDelivery[0])) {
                    $this->standardDelivery = $standardDelivery[0];
                }
            }
            if ($value->type == 'advance_payment') {

                $amount = json_validate($value['data']) ? json_decode($value['data'], true) : [];

                $this->advanceAmount = (float) $amount;

            }
            if ($value->type == 'advance_payment_limit') {

                $amountLimit = json_validate($value['data']) ? json_decode($value['data'], true) : [];

                $this->advanceAmountLimit = (float) $amountLimit;

            }
            if ($value->type == 'switch_landing_url') {

                $sUrl = json_validate($value['data']) ? json_decode($value['data'], true) : [];

                $this->sUrl = $sUrl;

            }
            if ($value->type == 'switch_client_id') {

                $sClient = json_validate($value['data']) ? json_decode($value['data'], true) : [];

                $this->sClientID = $sClient;

            }
            if ($value->type == 'switch_secret_key') {

                $sSecret = json_validate($value['data']) ? json_decode($value['data'], true) : [];

                $this->sSecret = $sSecret;

            }
            if ($value->type == 'shipping_charges') {

                $shipping_charges = json_validate($value['data']) ? json_decode($value['data'], true) : [];

                $this->shippingCharges = $shipping_charges;

            }
            if ($value->type == 'shipping_charge_limit') {

                $shipping_charge_limit = json_validate($value['data']) ? json_decode($value['data'], true) : [];

                $this->shippingChargeLimit = $shipping_charge_limit;

            }
        }

        if (isset($hasSameDayDelivery) && ! $hasSameDayDelivery) {
            $this->sameDayDelivery = [];
            foreach ($this->availableCities as $key => $city) {
                $this->sameDayDelivery[$city][0] = ['from' => '00:00', 'to' => '00:00'];
            }
        }
    }

    #[Computed]
    public function standardDeliveries()
    {
        // Initialize an empty array
        $carbonDate = [];

                           // Set the number of days and months you want to cover
        $totalDays   = 30; // Number of days before switching to months
        $totalMonths = 2;  // Number of months to cover after days

        // Loop to populate the array for days
        for ($day = 1; $day <= $totalDays; $day++) {
            $hours              = $day * 24; // Calculate total hours
            $carbonDate[$hours] = "Within $day day" . ($day > 1 ? "s" : "");
        }

        // Loop to populate the array for months (assuming 30 days per month)
        for ($month = 1; $month <= $totalMonths; $month++) {
            $hours              = $month * 30 * 24; // Calculate total hours for each month
            $carbonDate[$hours] = "Within $month month" . ($month > 1 ? "s" : "");
        }

        return $carbonDate;
    }

    #[Computed]
    public function cities()
    {
        $district = DB::table('pakistan_districts');
        return $district->get();
    }

    #[Computed]
    public function currencies()
    {
        return currency()->getCurrencies();
    }

    public function addSameDayDelivery()
    {
        $count = count($this->sameDayDelivery);

        $this->sameDayDelivery[$count] = ['from' => '00:00', 'to' => '00:00'];

        $this->dispatch('hide-loader');
    }

    public function deleteSameDayDelivery($index)
    {
        if (isset($this->sameDayDelivery[$index])) {
            if (isset($this->sameDayDelivery[$index]['id'])) {
                oSettings::where('id', $this->sameDayDelivery[$index]['id'])->delete();
            }
            unset($this->sameDayDelivery[$index]);
        }
        $sameDayDelivery = [];

        foreach ($this->sameDayDelivery as $key => $value) {
            $sameDayDelivery[] = $value;
        }

        $this->sameDayDelivery = $sameDayDelivery;

        $this->dispatch('hide-loader');
    }

    public function saveGeneral()
    {

        $settings = oSettings::whereIn('type', ['default_currency', 'available_for', 'delivery_on'])->get();
        $hasType  = [];

        foreach ($settings as $key => $value) {
            if ($value->type == 'default_currency') {
                $hasType[] = $value->type;
                $value->update([
                    'data' => json_encode([$this->defaultCurrency]),
                ]);
            }
            if ($value->type == 'available_for') {
                $hasType[] = $value->type;
                $value->update([
                    'data' => json_encode($this->availableCities),
                ]);
            }
            if ($value->type == 'delivery_on') {
                $hasType[] = $value->type;
                $value->update([
                    'data' => json_encode($this->deliveryOn),
                ]);
            }
        }

        if (! in_array('default_currency', $hasType)) {
            oSettings::create([
                'type' => 'default_currency',
                'data' => json_encode([$this->defaultCurrency]),
            ]);
        }

        if (! in_array('available_for', $hasType)) {
            oSettings::create([
                'type' => 'available_for',
                'data' => json_encode($this->availableCities),
            ]);
        }

        if (! in_array('delivery_on', $hasType)) {
            oSettings::create([
                'type' => 'delivery_on',
                'data' => json_encode($this->deliveryOn),
            ]);
        }

        if (count($this->sameDayDelivery) == 0) {
            $this->sameDayDelivery = [];
            foreach ($this->availableCities as $key => $city) {
                $this->sameDayDelivery[$city][0] = ['from' => '00:00', 'to' => '00:00'];
            }
        }

        $this->dispatch('os-notification', type: 'success', title: 'General Settings Saved Successfully', message: 'The general settings has been successfully saved. 🎉');
        $this->dispatch('hide-loader');
    }

    public function saveShipping()
    {

        $settings = oSettings::whereIn('type', ['same_day_delivery', 'standard_delivery', 'delivery_time'])->get();

        $hasType = [];

        foreach ($settings as $key => $value) {
            $hasType[] = $value->type;
            if ($value->type == 'same_day_delivery') {
                $value->update([
                    'data' => json_encode($this->sameDayDelivery),
                ]);
            }
            if ($value->type == 'standard_delivery') {
                $value->update([
                    'data' => json_encode([$this->standardDelivery]),
                ]);
            }
            if ($value->type == 'delivery_time') {
                $value->update([
                    'data' => json_encode($this->deliveryTime),
                ]);
            }
        }

        if (! in_array('same_day_delivery', $hasType)) {
            oSettings::create([
                'type' => 'same_day_delivery',
                'data' => json_encode($this->sameDayDelivery),
            ]);
        }

        if (! in_array('standard_delivery', $hasType)) {
            oSettings::create([
                'type' => 'standard_delivery',
                'data' => json_encode([$this->standardDelivery]),
            ]);
        }

        if (! in_array('delivery_time', $hasType)) {
            oSettings::create([
                'type' => 'delivery_time',
                'data' => json_encode($this->deliveryTime),
            ]);
        }

        $this->dispatch('os-notification', type: 'success', title: 'Shipping Settings Saved Successfully', message: 'The shipping settings has been successfully saved. 🎉');
        $this->dispatch('hide-loader');
    }

    public function saveAdvance()
    {

        $settings = oSettings::whereIn('type', ['advance_payment', 'advance_payment_limit'])->get();
        $hasType  = [];

        foreach ($settings as $key => $value) {
            if ($value->type == 'advance_payment') {
                $hasType[] = $value->type;
                $value->update([
                    'data' => json_encode($this->advanceAmount),
                ]);
            }
            if ($value->type == 'advance_payment_limit') {
                $hasType[] = $value->type;
                $value->update([
                    'data' => json_encode($this->advanceAmountLimit),
                ]);
            }

        }

        if (! in_array('advance_payment', $hasType)) {
            oSettings::create([
                'type' => 'advance_payment',
                'data' => json_encode($this->advanceAmount),
            ]);
        }

        if (! in_array('advance_payment_limit', $hasType)) {
            oSettings::create([
                'type' => 'advance_payment_limit',
                'data' => json_encode($this->advanceAmountLimit),
            ]);
        }

        $this->dispatch('os-notification', type: 'success', title: 'Settings Saved Successfully', message: 'The advance payment settings has been successfully saved. 🎉');
        $this->dispatch('hide-loader');
    }

    public function saveSwitchPayment()
    {

        $settings = oSettings::whereIn('type', ['switch_landing_url', 'switch_client_id', 'switch_secret_key'])->get();
        $hasType  = [];

        foreach ($settings as $key => $value) {
            if ($value->type == 'switch_landing_url') {
                $hasType[] = $value->type;
                $value->update([
                    'data' => json_encode($this->sUrl),
                ]);
            }
            if ($value->type == 'switch_client_id') {
                $hasType[] = $value->type;
                $value->update([
                    'data' => json_encode($this->sClientID),
                ]);
            }
            if ($value->type == 'switch_secret_key') {
                $hasType[] = $value->type;
                $value->update([
                    'data' => json_encode($this->sSecret),
                ]);
            }
        }

        if (! in_array('switch_landing_url', $hasType)) {
            oSettings::create([
                'type' => 'switch_landing_url',
                'data' => json_encode($this->sUrl),
            ]);
        }

        if (! in_array('switch_client_id', $hasType)) {
            oSettings::create([
                'type' => 'switch_client_id',
                'data' => json_encode($this->sClientID),
            ]);
        }

        if (! in_array('switch_secret_key', $hasType)) {
            oSettings::create([
                'type' => 'switch_secret_key',
                'data' => json_encode($this->sSecret),
            ]);
        }

        $this->dispatch('os-notification', type: 'success', title: 'Settings Saved Successfully', message: 'The switch payment settings has been successfully saved. 🎉');
        $this->dispatch('hide-loader');
    }

    public function saveShippingCharges()
    {

        $settings = oSettings::whereIn('type', ['shipping_charges', 'shipping_charge_limit'])->get();
        $hasType  = [];

        foreach ($settings as $key => $value) {
            if ($value->type == 'shipping_charges') {
                $hasType[] = $value->type;
                $value->update([
                    'data' => json_encode($this->shippingCharges),
                ]);
            }
            if ($value->type == 'shipping_charge_limit') {
                $hasType[] = $value->type;
                $value->update([
                    'data' => json_encode($this->shippingChargeLimit),
                ]);
            }

        }

        if (! in_array('shipping_charges', $hasType)) {
            oSettings::create([
                'type' => 'shipping_charges',
                'data' => json_encode($this->shippingCharges),
            ]);
        }

        if (! in_array('shipping_charge_limit', $hasType)) {
            oSettings::create([
                'type' => 'shipping_charge_limit',
                'data' => json_encode($this->shippingChargeLimit),
            ]);
        }

        $this->dispatch('os-notification', type: 'success', title: 'Settings Saved Successfully', message: 'The shipping charges settings has been successfully saved. 🎉');
        $this->dispatch('hide-loader');
    }

    public function render()
    {
        return view('livewire.admin.order.order-settings')->extends('admin.layout.master', ['title' => $this->title, 'breadCrumb' => $this->breadCrumb])->section('content');
    }
}
