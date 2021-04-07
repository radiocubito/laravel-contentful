<?php

namespace Radiocubito\Wordful\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AuthLayout extends Component
{
    public function render(): View
    {
        return view('wordful::layouts.auth');
    }
}
