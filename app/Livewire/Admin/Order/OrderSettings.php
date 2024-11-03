<?php

namespace App\Livewire\Admin\Order;

use Livewire\Component;

class OrderSettings extends Component
{
    public $title = 'Order Settings';

    public $breadCrumb = 'Home.Order.Settings';

    public function render()
    {
        return view('livewire.admin.order.order-settings')->extends('admin.layout.master', ['title' => $this->title, 'breadCrumb' => $this->breadCrumb])->section('content');
    }
}
