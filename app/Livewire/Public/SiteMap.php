<?php
namespace App\Livewire\Public;

use Livewire\Component;

class SiteMap extends Component
{
    public $title      = 'Site Map';
    public $breadCrumb = 'Home.Site.Map';

    public function render()
    {
        return view('livewire.public.site-map')->extends('layout.public-master', ['title' => $this->title, 'breadCrumb' => $this->breadCrumb])->section('content');
    }
}