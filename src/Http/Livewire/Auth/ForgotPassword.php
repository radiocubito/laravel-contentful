<?php

namespace Radiocubito\Wordful\Http\Livewire\Auth;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Password;
use Livewire\Component;

class ForgotPassword extends Component
{
    public $email = '';

    public function rules()
    {
        return [
            'email' => 'required|string|email',
        ];
    }

    public function emailPassword()
    {
        $this->validate();

        ResetPassword::createUrlUsing(function ($notifiable, $token) {
            return url(route('wordful.password.reset', [
                'token' => $token,
                'email' => $notifiable->getEmailForPasswordReset(),
            ], false));
        });

        $status = Password::sendResetLink(
            ['email' => $this->email]
        );

        if ($status == Password::RESET_LINK_SENT) {
            session()->flash('status', __($status));

            $this->email = '';
        } else {
            $this->addError('email', __($status));
        }
    }

    public function render()
    {
        return view('wordful::livewire.auth.forgot-password')->layout('wordful::layouts.auth');
    }
}
