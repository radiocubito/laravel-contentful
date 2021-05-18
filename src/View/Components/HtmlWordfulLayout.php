<?php

namespace Radiocubito\Wordful\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class HtmlWordfulLayout extends Component
{
    public function render(): View
    {
        return view('wordful::layouts.html-wordful');
    }
}
