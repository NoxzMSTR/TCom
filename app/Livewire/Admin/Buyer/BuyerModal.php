<?php

namespace App\Livewire\Admin\Buyer;

use App\Models\Buyers;
use App\Models\Vendors;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Computed;
use Monarobase\CountryList\CountryListFacade;

class BuyerModal extends Component
{
    public $buyer = [];
    public $hasBuyer = null;

    #[Computed]
    public function country()
    {
        return CountryListFacade::getOne('PK', 'en');;
    }

    #[On('update-buyer')]
    public function beforeUpdate($id)
    {
        $this->clear();

        $buyer = Buyers::find($id);

        if ($buyer) {
            $this->hasBuyer = $buyer;
            $this->buyer['type'] = $buyer->type;
            $this->buyer['fname'] = $buyer->firstName;
            $this->buyer['company'] = $buyer->company;
            $this->buyer['address'] = $buyer->address;
            $this->buyer['address2'] = $buyer->address2;
            $this->buyer['city'] = $buyer->city;
            $this->buyer['state'] = $buyer->state;
            $this->buyer['country'] = $buyer->country;
            $this->buyer['postalCode'] = $buyer->postalCode;
            $this->buyer['phone'] = $buyer->phone;
            $this->buyer['email'] = $buyer->email;

            $this->dispatch('show-buyer-modal');
        } else {
            $this->dispatch('hide-loader');
        }
    }

    public function update()
    {
        if ($this->hasBuyer) {
            $this->hasBuyer->update([
                'type' => $this->buyer['type'],
                'firstName' => $this->buyer['fname'],
                'company' => $this->buyer['company'],
                'address' => $this->buyer['address'],
                'address2' => $this->buyer['address2'],
                'city' => $this->buyer['city'],
                'state' => $this->buyer['state'],
                'country' => $this->buyer['country'],
                'postalCode' => $this->buyer['postalCode'],
                'phone' => $this->buyer['phone'],
                'email' => $this->buyer['email'],
            ]);
        }
        $this->dispatch('refreshDatatable');
        $this->dispatch('hide-buyer-modal');
    }

    public function clear()
    {
        $this->buyer = [];
    }

    public function render()
    {
        return view('livewire.admin.buyer.buyer-modal');
    }
}
