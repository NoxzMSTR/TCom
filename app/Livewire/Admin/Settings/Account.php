<?php

namespace App\Livewire\Admin\Settings;

use Livewire\Component;

class Account extends Component
{
    public $title = 'Account';

    public $breadCrumb = 'Home.Settings.Account';

    public function render()
    {
        return view('livewire.admin.settings.account')->extends('admin.layout.master', ['title' => $this->title, 'breadCrumb' => $this->breadCrumb])->section('content');
    }
}
