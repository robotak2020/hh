<?php

namespace App\Controllers\news\Common;

use System\Controller;

class HeaderController extends Controller
{
    public function index()
    {
        $data['title'] = $this->html->getTitle();

        $loginModel = $this->load->model('Login');

        $data['user'] = $loginModel->isLogged() ? $loginModel->user() : null;

        $data['categories'] = $this->load->model('Categories')->getEnabledCategoriesWithNumberOfTotalPosts();

        return $this->view->render('news/common/header', $data)->getOutput();
    }
}