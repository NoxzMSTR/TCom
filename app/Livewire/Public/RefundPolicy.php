<?php

namespace App\Livewire\Public;

use Livewire\Component;

class RefundPolicy extends Component
{
    public $title = 'Refund Policy';
    public $breadCrumb = 'Home.Refund.Policy';

    public function render()
    {
        return view('livewire.public.refund-policy')->extends('layout.public-master', ['title' => $this->title, 'breadCrumb' => $this->breadCrumb])->section('content');
    }
}
