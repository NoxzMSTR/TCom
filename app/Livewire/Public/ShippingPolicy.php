<?php
namespace App\Livewire\Public;

use Livewire\Component;

class ShippingPolicy extends Component
{
    public $title      = 'Shipping Policy';
    public $breadCrumb = 'Home.Shipping.Policy';

    public function render()
    {
        return view('livewire.public.shipping-policy')->extends('layout.public-master', ['title' => $this->title, 'breadCrumb' => $this->breadCrumb])->section('content');
    }
}