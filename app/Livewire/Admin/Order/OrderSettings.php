<?php

namespace App\Livewire\Admin\Order;

use Livewire\Component;
use Livewire\Attributes\Computed;
use Aaqib\GeoPakistan\Models\District;
use App\Models\Order\OrderSettings as oSettings;
use Illuminate\Support\Facades\DB;

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

    public function mount()
    {
        $settings = oSettings::all();
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
            $hasSameDayDelivery = false;
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
        }
    }

    #[Computed]
    public function standardDeliveries()
    {
        // Initialize an empty array
        $carbonDate = [];

        // Set the number of days and months you want to cover
        $totalDays = 30; // Number of days before switching to months
        $totalMonths = 2; // Number of months to cover after days

        // Loop to populate the array for days
        for ($day = 1; $day <= $totalDays; $day++) {
            $hours = $day * 24; // Calculate total hours
            $carbonDate[$hours] = "Within $day day" . ($day > 1 ? "s" : "");
        }

        // Loop to populate the array for months (assuming 30 days per month)
        for ($month = 1; $month <= $totalMonths; $month++) {
            $hours = $month * 30 * 24; // Calculate total hours for each month
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
        $hasType = [];

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

        if (!in_array('default_currency', $hasType)) {
            oSettings::create([
                'type' => 'default_currency',
                'data' => json_encode([$this->defaultCurrency]),
            ]);
        }

        if (!in_array('available_for', $hasType)) {
            oSettings::create([
                'type' => 'available_for',
                'data' => json_encode($this->availableCities),
            ]);
        }

        if (!in_array('delivery_on', $hasType)) {
            oSettings::create([
                'type' => 'delivery_on',
                'data' => json_encode($this->deliveryOn),
            ]);
        }
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

        if (!in_array('same_day_delivery', $hasType)) {
            oSettings::create([
                'type' => 'same_day_delivery',
                'data' => json_encode($this->sameDayDelivery),
            ]);
        }

        if (!in_array('standard_delivery', $hasType)) {
            oSettings::create([
                'type' => 'standard_delivery',
                'data' => json_encode([$this->standardDelivery]),
            ]);
        }

        if (!in_array('delivery_time', $hasType)) {
            oSettings::create([
                'type' => 'delivery_time',
                'data' => json_encode($this->deliveryTime),
            ]);
        }
        $this->dispatch('hide-loader');
    }

    public function render()
    {
        return view('livewire.admin.order.order-settings')->extends('admin.layout.master', ['title' => $this->title, 'breadCrumb' => $this->breadCrumb])->section('content');
    }
}
