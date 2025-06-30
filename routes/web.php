<?php

use App\Apps\Controllers\HomeController;
use App\Core\Routes\Po;

Po::get('/', [HomeController::class, 'index']);
Po::get('/about', [HomeController::class, 'about']);
