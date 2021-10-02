<?php

namespace App\Controllers;

use App\Models\ClientModel;

class Home extends BaseController
{
    public function index()
    {
        $clientmodel = new ClientModel();

        $dataclient = $clientmodel->get();

        return view('welcome_message', ['clients'=>$dataclient]);
    }
}
