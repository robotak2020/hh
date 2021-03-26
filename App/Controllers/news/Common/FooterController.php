<?php

namespace App\Controllers\news\Common;

use System\Controller;

class FooterController extends Controller
{
    public function index()
    {
        $data['user'] = $this->load->model('Login')->user();

        return $this->view->render('news/common/footer', $data);
    }
}