<?php

namespace App\Controllers\exam\Common;

use System\Controller;

class SidebarController extends Controller
{
    public function index()
    {


        return $this->view->render('exam/common/sidebar');
    }
}