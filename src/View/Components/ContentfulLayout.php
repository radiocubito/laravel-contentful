<?php

namespace Radiocubito\Contentful\View\Components;

use Illuminate\View\Component;

class ContentfulLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('contentful::layouts.contentful');
    }
}
