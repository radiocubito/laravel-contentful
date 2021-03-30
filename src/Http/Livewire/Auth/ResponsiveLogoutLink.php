<?php

namespace Radiocubito\Wordful\Http\Livewire\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ResponsiveLogoutLink extends Component
{
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function render()
    {
        return view('wordful::livewire.auth.responsive-logout-link');
    }
}
