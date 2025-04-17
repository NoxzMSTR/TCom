<?php
namespace App\Livewire\Admin\Vendor;

use App\Models\Vendors;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Monarobase\CountryList\CountryListFacade;

class VendorModal extends Component
{
    #[Validate([
            'vendor.fname'      => ['required'],
            'vendor.company'    => ['required'],
            'vendor.address'    => ['required'],
            'vendor.city'       => ['required'],
            'vendor.state'      => ['required'],
            'vendor.country'    => ['required'],
            'vendor.postalCode' => ['required'],
            'vendor.phone'      => ['required'],
            'vendor.email'      => ['required'],
        ], message: [
            'vendor.fname'      => 'Enter the vendor full name.',
            'vendor.company'    => 'Please provide the vendor company.',
            'vendor.address'    => 'Please provide the vendor address.',
            'vendor.city'       => 'Please enter the vendor city.',
            'vendor.state'      => 'Please enter the vendor state.',
            'vendor.country'    => 'Please select the vendor country.',
            'vendor.postalCode' => 'Please enter the vendor post code.',
            'vendor.phone'      => 'Please enter the vendor phone.',
            'vendor.email'      => 'Please enter the vendor email.',
        ])]
    public $vendor = [];
    public $cities = [];
    public $hasVendor = null;

    #[Computed]
    public function country()
    {
        return CountryListFacade::getOne('PK', 'en');
    }

    #[On('update-vendor')]
    public function beforeUpdate($id)
    {
        $this->clear();

        $vendor = Vendors::find($id);

        if ($vendor) {
            $this->hasVendor            = $vendor;
            $this->vendor['fname']      = $vendor->name;
            $this->vendor['company']    = $vendor->company;
            $this->vendor['address']    = $vendor->address;
            $this->vendor['address2']   = $vendor->address2;
            $this->vendor['city']       = $vendor->city;
            $this->vendor['state']      = $vendor->state;
            $this->vendor['country']    = $vendor->country;
            $this->vendor['postalCode'] = $vendor->postalCode;
            $this->vendor['phone']      = $vendor->phone;
            $this->vendor['email']      = $vendor->email;

            $this->dispatch('show-vendor-modal');
        } else {
            $this->vendor = [];
            $this->dispatch('show-vendor-modal');
            $this->dispatch('hide-loader');
        }
    }

    public function update()
    {
        $this->validate();

        if ($this->hasVendor) {
            $this->hasVendor->update([
                'name'       => $this->vendor['fname'],
                'company'    => $this->vendor['company'],
                'address'    => $this->vendor['address'],
                'address2'   => $this->vendor['address2'],
                'city'       => $this->vendor['city'],
                'state'      => $this->vendor['state'],
                'country'    => $this->vendor['country'],
                'postalCode' => $this->vendor['postalCode'],
                'phone'      => $this->vendor['phone'],
                'email'      => $this->vendor['email'],
            ]);
        } else {
            Vendors::create([
                'name'       => $this->vendor['fname'],
                'company'    => $this->vendor['company'],
                'address'    => $this->vendor['address'],
                'address2'   => $this->vendor['address2'],
                'city'       => $this->vendor['city'],
                'state'      => $this->vendor['state'],
                'country'    => $this->vendor['country'],
                'postalCode' => $this->vendor['postalCode'],
                'phone'      => $this->vendor['phone'],
                'email'      => $this->vendor['email'],
            ]);
            $this->vendor = [];
        }
        $this->dispatch('refreshDatatable');
        $this->dispatch('hide-vendor-modal');
    }

    public function clear()
    {
        $this->vendor = [];
    }

    public function render()
    {
        return view('livewire.admin.vendor.vendor-modal');
    }
}