<?php

namespace App\Livewire\Public;

use App\Models\Contacts;
use Livewire\Component;
use Livewire\Attributes\Validate;

class ContactUs extends Component
{
    public $title = 'Contact Us';
    public $breadCrumb = 'Home.Contact.Us';

    #[Validate('required|min:3', message: 'Please enter your full name.')]
    public $name;
    #[Validate('required|email', message: 'Please enter your valid email.')]
    public $email;
    #[Validate('required', message: 'Please enter your phone number.')]
    public $phone;
    #[Validate('required|min:3|max:50', message: 'Please enter purpose of your contact and only 50 characters are allowed.')]
    public $subject;
    #[Validate('required|min:3|max:150', message: 'Please describe your query and only 150 characters are allowed.')]
    public $message;

    public function submit()
    {
        $this->validate();

        Contacts::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'subject' => $this->subject,
            'message' => $this->message,
        ]);

        $this->reset();
    }

    public function render()
    {
        return view('livewire.public.contact-us')->extends('layout.public-master', ['title' => $this->title, 'breadCrumb' => $this->breadCrumb])->section('content');
    }
}
