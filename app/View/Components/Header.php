<?php

namespace App\View\Components;

use Illuminate\View\Component;
use \Illuminate\Session\SessionManager;

use Illuminate\Support\Facades\Auth;


class Header extends Component
{
    public $title;
    public $description;

    public function __construct(string $title, SessionManager $session, $description = null)
    {
        $this->title = $title;

        $this->description = $description;

        // Redirect to dashboard
        if (!is_null($session->get('disableRedirectToDashboard')) && $session->get('disableRedirectToDashboard') == false) {
            $session->put('disableRedirectToDashboard', true);
            return redirect()->to('/');
        }
    }
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('layouts.header');
    }
}
