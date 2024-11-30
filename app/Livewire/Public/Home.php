<?php

namespace App\Livewire\Public;

use Livewire\Component;

class Home extends Component
{
    public $title = 'Home';

    public function render()
    {
        return view('livewire.public.home')->extends('layout.public-master', ['title' => $this->title])->section('content');
    }
}
