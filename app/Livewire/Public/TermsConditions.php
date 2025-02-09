<?php

namespace App\Livewire\Public;

use Livewire\Component;

class TermsConditions extends Component
{
    public $title = 'Terms & Conditions';
    public $breadCrumb = 'Home.Terms & Conditions';

    public function render()
    {
        return view('livewire.public.terms-conditions')->extends('layout.public-master', ['title' => $this->title, 'breadCrumb' => $this->breadCrumb])->section('content');
    }
}
