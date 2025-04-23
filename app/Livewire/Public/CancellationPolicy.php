<?php
namespace App\Livewire\Public;

use Livewire\Component;

class CancellationPolicy extends Component
{
    public $title      = 'Cancellation Policy';
    public $breadCrumb = 'Home.Cancellation.Policy';

    public function render()
    {
        return view('livewire.public.cancellation-policy')->extends('layout.public-master', ['title' => $this->title, 'breadCrumb' => $this->breadCrumb])->section('content');
    }

}