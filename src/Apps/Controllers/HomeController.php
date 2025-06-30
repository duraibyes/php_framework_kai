<?php

namespace App\Apps\Controllers;

use App\Core\Http\Request;

class HomeController
{
    public function index(Request $request)
    {
        show('Request Method: ', $request->all());
        echo 'Welcome to the home page!';
    }
    public function about()
    {
        echo 'This is the about page.';
    }
}
