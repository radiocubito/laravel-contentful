<?php

namespace Radiocubito\Wordful\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class DevWordfulLayout extends Component
{
    public function render(): View
    {
        return view('wordful::layouts.dev-wordful');
    }
}
