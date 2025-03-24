<?php

namespace App\Livewire\Public;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Renderless;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\Accounts\AuthenticateMail;
use App\Mail\Accounts\RegistrationMail;
use Illuminate\Validation\ValidationException;

class Login extends Component
{
    #[Validate('required|email', message: 'Please enter your valid email.')]
    public $email;

    #[Renderless]
    public function login()
    {
        $this->dispatch('login-error-message', messages: null);

        $this->validate();

        $user = User::where('email', $this->email)->first();

        $name = isset(system_config['name']['value']) ? system_config['name']['value'] : '';

        if ($user) {

            $type = 'auth-token-' . rand(75543435, 965245474);

            $id = session()->getId();

            $url = route('public.login', ['token' => $type . '-' . $id]);

            sharedProperty($type, $user);

            $user->update(['token' => $type . '-' . $id]);

           try {
            Mail::to($this->email)->send(new AuthenticateMail('Welcome back to ' . $name, $user, $url));
           } catch (\Throwable $th) {
            throw ValidationException::withMessages(['email' => 'Ops! Something went wrong']);
           }
        } else {
            throw ValidationException::withMessages(['email' => 'Ops user not found, Kindly click on signup to register on customer portal.']);
        }

        $this->dispatch('mail-sent');
    }
    #[Renderless]
    public function register()
    {
        $this->dispatch('login-error-message', messages: null);

        $this->validate();

        $user = User::where('email', $this->email)->first();

        $name = isset(system_config['name']['value']) ? system_config['name']['value'] : '';

        if ($user) {
            $this->login();
        } else {
            $type = 'auth-token-' . rand(75543435, 965245474);

            $id = session()->getId();

            $url = route('public.login', ['token' => $type . '-' . $id]);

            $user =  User::create([
                'name' => '',
                'email' => $this->email,
                'password' => '',
                'token' => $type . '-' . $id
            ]);

            sharedProperty($type, $user);

            try {
                Mail::to($this->email)->send(new RegistrationMail('Welcome to ' . $name, $user, $url));
            } catch (\Throwable $th) {
                throw ValidationException::withMessages(['email' => 'Ops! Something went wrong']);
            }

            $this->dispatch('mail-sent');
        }
    }

    public function exception()
    {
        $this->dispatch('login-error-message', messages: $this->getErrorBag());
    }

    public function auth()
    {
        $token = request('token');

        $user = User::where('token', $token)->first();

        if ($user) {
            Auth::login($user);
            $user->update(['token' => null]);
            // Redirect to the intended page
            return redirect()->route('public.account');
        }
    }
    public function logout()
    {
        Auth::guard('web')->logout();
        // Redirect to the intended page
        return redirect()->route('public.home');
    }

    public function render()
    {
        return view('livewire.public.login');
    }
}
