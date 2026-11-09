<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class GuestLayout extends Component
{
    /**
     * @param  string|null  $title  Page title shown in the browser tab.
     */
    public function __construct(public ?string $title = null)
    {
    }

    public function render(): View
    {
        return view('layouts.guest');
    }
}
