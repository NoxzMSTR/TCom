<?php

namespace App\Livewire\Public;

use Livewire\Component;

class PrivacyPolicy extends Component
{
    public $title = 'Privacy Policy';
    public $breadCrumb = 'Home.Privacy.Policy';

    public function render()
    {
        return view('livewire.public.privacy-policy')->extends('layout.public-master', ['title' => $this->title, 'breadCrumb' => $this->breadCrumb])->section('content');
    }
}
