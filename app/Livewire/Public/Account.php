<?php

namespace App\Livewire\Public;

use App\Models\User;
use Livewire\Component;
use App\Models\UserAddress;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Renderless;
use Illuminate\Support\Facades\Auth;

class Account extends Component
{
    public $title = 'My Account';
    public $breadCrumb = 'Home.My Account';

    public $userIP;

    public $name;

    public $email;

    public $billingName;

    public $billingCompany;

    #[Validate('required|min:3', message: 'Please provide a billing address')]
    public $billingAddress;

    public $billingAddress2;

    #[Validate('required|min:3', message: 'Please provide a billing city')]
    public $billingCity;

    #[Validate('required|min:3', message: 'Please provide a billing email')]
    public $billingEmail;

    #[Validate('required|min:3', message: 'Please provide a billing phone')]
    public $billingPhone;

    public $shippingName;

    public $shippingCompany;

    #[Validate('required|min:3', message: 'Please provide a shipping address')]
    public $shippingAddress;

    public $shippingAddress2;

    #[Validate('required|min:3', message: 'Please provide a shipping city')]
    public $shippingCity;

    #[Validate('required|min:3', message: 'Please provide a shipping email')]
    public $shippingEmail;

    #[Validate('required|min:3', message: 'Please provide a shipping phone')]
    public $shippingPhone;

    #[Renderless]
    public function updateAccount()
    {
        $this->validate(['name' => 'required|min:3', 'email' => 'required|min:3']);

        $user = User::find(Auth::id());

        if ($user) {
            $user->update([
                'name' => $this->name,
                'email' => $this->email,
            ]);
        }
    }


    public function updateBilling()
    {
        $this->validate(['billingAddress' => 'required|min:3', 'billingCity' => 'required|min:3', 'billingEmail' => 'required|min:3', 'billingPhone' => 'required|min:3']);

        $billing = DB::table('pakistan_districts')->select(['pakistan_districts.name as city', 'pakistan_provinces.name as state'])->join('pakistan_provinces', 'pakistan_districts.province_id', '=', 'pakistan_provinces.id')->where('pakistan_districts.name', $this->billingCity)->first();

        $hasBilling = UserAddress::where('type', 0)->where('userID', Auth::id())->first();

        try {
            $location = getCountry($this->userIP);
        } catch (\Throwable $th) {
            //throw $th;
        }

        $country = isset($location['country']) ? $location['country'] : 'Pakistan';

        $postalCode = isset($location['zip']) ? $location['zip'] : '0';

        $region = $billing ? $billing->state : 'Punjab';

        if ($hasBilling) {
            $hasBilling->update([
                'name' => $this->billingName,
                'company' => $this->billingCompany,
                'address' => $this->billingAddress,
                'address2' => $this->billingAddress2,
                'postalCode' => $postalCode,
                'city' => $this->billingCity,
                'region' => $region,
                'country' => $country,
                'email' => $this->billingEmail,
                'phone' => $this->billingPhone,
            ]);
        } else {
            UserAddress::create([
                'userID' => Auth::id(),
                'type' => 0,
                'name' => $this->billingName,
                'company' => $this->billingCompany,
                'address' => $this->billingAddress,
                'address2' => $this->billingAddress2,
                'postalCode' => $postalCode,
                'city' => $this->billingCity,
                'region' => $region,
                'country' => $country,
                'email' => $this->billingEmail,
                'phone' => $this->billingPhone,
            ]);
        }
    }

    public function updateShipping()
    {
        $this->validate(['shippingAddress' => 'required|min:3', 'shippingCity' => 'required|min:3', 'shippingEmail' => 'required|min:3', 'shippingPhone' => 'required|min:3']);

        $shipping = DB::table('pakistan_districts')->select(['pakistan_districts.name as city', 'pakistan_provinces.name as state'])->join('pakistan_provinces', 'pakistan_districts.province_id', '=', 'pakistan_provinces.id')->where('pakistan_districts.name', $this->shippingCity)->first();

        $hasShipping = UserAddress::where('type', 1)->where('userID', Auth::id())->first();

        try {
            $location = getCountry($this->userIP);
        } catch (\Throwable $th) {
            //throw $th;
        }

        $country = isset($location['country']) ? $location['country'] : 'Pakistan';

        $postalCode = isset($location['zip']) ? $location['zip'] : '0';

        $region = $shipping ? $shipping->state : 'Punjab';

        if ($hasShipping) {
            $hasShipping->update([
                'name' => $this->shippingName,
                'company' => $this->shippingCompany,
                'address' => $this->shippingAddress,
                'address2' => $this->shippingAddress2,
                'postalCode' => $postalCode,
                'city' => $this->shippingCity,
                'region' => $region,
                'country' => $country,
                'email' => $this->shippingEmail,
                'phone' => $this->shippingPhone,
            ]);
        } else {
            UserAddress::create([
                'userID' => Auth::id(),
                'type' => 1,
                'name' => $this->shippingName,
                'company' => $this->shippingCompany,
                'address' => $this->shippingAddress,
                'address2' => $this->shippingAddress2,
                'postalCode' => $postalCode,
                'city' => $this->shippingCity,
                'region' => $region,
                'country' => $country,
                'email' => $this->shippingEmail,
                'phone' => $this->shippingPhone,
            ]);
        }
    }

    public function render()
    {
        return view('livewire.public.account')->extends('layout.public-master', ['title' => $this->title, 'breadCrumb' => $this->breadCrumb])->section('content');
    }

    public function orders()
    {
        return view('livewire.public.partials.account.my-orders', ['title' => 'My Orders', 'breadCrumb' => 'Home.My Orders']);
    }
}
