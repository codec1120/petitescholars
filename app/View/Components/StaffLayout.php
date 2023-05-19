<?php

namespace App\View\Components;

use Illuminate\View\Component;

use App\Models\User;

class StaffLayout extends Component
{
    public User $user;
    public $title;
    public $layout;
    public $threerowlayout;
    public $title1;
    public $title2;
    public $title3;

    public function __construct(User $user, $title = '', $layout = null , $threerowlayout = false, $title1 = '', $title2 = '', $title3 = '')
    {
        $this->user = $user;
        $this->title = $title;
        $this->layout = $layout ?? 'split';
        $this->threerowlayout = $threerowlayout;
        $this->title1 = $title1;
        $this->title2 = $title2;
        $this->title3 = $title3;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('layouts.staff');
    }
}
