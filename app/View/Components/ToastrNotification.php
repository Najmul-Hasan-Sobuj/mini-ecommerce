<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ToastrNotification extends Component
{
    public $message;
    public $alertType;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->message = session()->get('message');
        $this->alertType = session()->get('alert-type', 'info');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.toastr-notification');
    }
}
