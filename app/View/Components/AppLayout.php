<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */

    public string $title;

    public function __construct($title = 'Default')
    {
        $this->title = $title;
    }

    public function render(): View
    {
        return view('layouts.app');
    }
}
