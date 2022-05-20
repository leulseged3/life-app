<?php

namespace App\View\Components\Layouts;

use Illuminate\View\Component;

class App extends Component
{
    public $currentpage;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($currentpage="Dashboard")
    {
        //
        $this->currentpage = $currentpage;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.layouts.app');
    }
}
