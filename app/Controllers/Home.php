<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $session = session();
        echo $session->get('logged_in');
        return view('welcome_message');
    }
}
