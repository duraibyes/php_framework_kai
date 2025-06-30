<?php

namespace App\Apps\Controllers;

use App\Core\Http\Request;

class TestController
{
    public function index(Request $request)
    {
        echo "🚀 TestController Controller is ready!";
    }
}