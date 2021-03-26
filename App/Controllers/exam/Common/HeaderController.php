<?php

namespace App\Controllers\exam\Common;

use System\Controller;

class HeaderController extends Controller
{
    public function index()
    {
        $data['title'] = $this->html->getTitle();

        $loginModel = $this->load->model('Login');

        $data['user'] = $loginModel->isLogged() ? $loginModel->user() : null;


        return $this->view->render('exam/common/header', $data)->getOutput();
    }
}