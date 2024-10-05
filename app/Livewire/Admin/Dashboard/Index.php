<?php

namespace App\Livewire\Admin\Dashboard;

use Livewire\Component;

class Index extends Component
{
    public $title = 'Dashboard';

    public $breadCrumb = 'Home.Dashboard';

    public function render()
    {
        return view('livewire.admin.dashboard.index')->extends('admin.layout.master', ['title' => $this->title, 'breadCrumb' => $this->breadCrumb])->section('content');
    }
}
