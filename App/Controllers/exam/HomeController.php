<?php

namespace App\Controllers\exam;

use System\Controller;

class HomeController extends Controller
{
     /**
     * Display Home Page
     *
     * @return mixed
     */
    public function index()
    {
        $loginModel = $this->load->model('Login');
        if ($loginModel->isLogged()) {
            $ExamModel = $this->load->model('exam');
            $user = $loginModel->user();

            $data['exam'] = $ExamModel->score(12,4);
            $data['result'] = $ExamModel->results(12,4);


            $this->html->setTitle($this->settings->get('site_name'));

            $view = $this->view->render('exam/home', $data);

            return $this->examLayout->render($view);
        }
        else{
            return $this->url->redirectTo('/login');
            }
    }
}