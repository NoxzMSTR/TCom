<?php

namespace App\Livewire\Public;

use Livewire\Component;

class AboutUs extends Component
{
    public $title = 'About Us';
    public $breadCrumb = 'Home.About.Us';

    public function render()
    {
        return view('livewire.public.about-us')->extends('layout.public-master', ['title' => $this->title, 'breadCrumb' => $this->breadCrumb])->section('content');
    }
}
