<?php

namespace App\Controllers\exam\Common;

use System\Controller;

class FooterController extends Controller
{
    public function index()
    {
        $data['user'] = $this->load->model('Login')->user();

        return $this->view->render('exam/common/footer', $data);
    }
}