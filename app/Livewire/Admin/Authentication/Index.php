<?php

namespace App\Livewire\Admin\Authentication;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class Index extends Component
{
    public $title = 'Login';
    public $rememberMe;
    #[Validate('required|min:3|email', message: 'Please provide a valid email.')]
    public $email;
    #[Validate('required', message: 'Please enter password.')]
    #[Validate('min:6', message: 'Password is too short.')]
    #[Validate('regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/', message: 'Password is not strong.')]
    public $password;

    public function login()
    {
        $this->validate();

        if (!Auth::attempt(array('email' => $this->email, 'password' => $this->password), (bool)$this->rememberMe)) {

            throw ValidationException::withMessages([
                'password' => trans('auth.failed'),
            ]);
        }

        $user = Auth::user();

        if (!$user) {
            return false;
        }

        if ($user->is_active == false) {
            Auth::guard('web')->logout();
            throw ValidationException::withMessages([
                'message' => 'User has been deactivated! Kindly Contact your administrator',
            ]);
        }

        Cookie::queue('userID', $user->id);

        return $this->redirect(route('admin.dashboard'), navigate: true);
    }

    public function logout()
    {
        Auth::guard('web')->logout();

        return redirect(route('admin.login'));
    }

    public function render()
    {
        return view('livewire.admin.authentication.index')->extends('admin.layout.login-master', ['title' => $this->title])->section('content');
    }
}
