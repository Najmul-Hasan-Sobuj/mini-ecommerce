<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CategoryDropdown extends Component
{
    public $categories;
    public $selectedId;

    /**
     * Create a new component instance.
     *
     * @param Collection $categories
     * @param int|null $selectedId
     */
    public function __construct($categories, $selectedId = null)
    {
        $this->categories = $categories;
        $this->selectedId = $selectedId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.category-dropdown');
    }
}
