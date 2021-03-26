<?php

namespace App\Controllers\news;

use System\Controller;

class LoginController extends Controller
{
    /**
    * Display Login Form
    *
    * @return mixed
    */
    public function index()
    {
        $this->newsLayout->title('Login');

        $loginModel = $this->load->model('Login');

        // disable sidebar
        $this->newsLayout->disable('sidebar');

        if ($loginModel->isLogged()) {
            return $this->url->redirectTo('/');
        }

        $data['errors'] = $this->errors;

        $view = $this->view->render('news/users/login', $data);

        return $this->newsLayout->render($view);
    }

    /**
    * Submit Login form
    *
    * @return mixed
    */
    public function submit()
    {
        if ($this->isValid()) {
            $loginModel = $this->load->model('Login');

            $loggedInUser = $loginModel->user();

            if ($this->request->post('remember')) {
                // save login data in cookie
                $this->cookie->set('login', $loggedInUser->code);
            } else {
                // save login data in session
                $this->session->set('login', $loggedInUser->code);
            }

            $json = [];

            $json['success']  = 'Welcome Back ' . $loggedInUser->first_name;

            $json['redirectTo'] = $this->url->link('/');

            return $this->json($json);
        } else {
            $json = [];

            $json['errors'] = implode('<br>', $this->errors);

            return $this->json($json);
        }
    }

    /**
    * Validate Login Form
    *
    * @return bool
    */
    private function isValid()
    {
        $email = $this->request->post('email');
        $password = $this->request->post('password');

        if (! $email) {
            $this->errors[] = 'Please Insert Email address';
        } elseif (! filter_var($email , FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = 'Please Insert Valid Email';
        }

        if (! $password) {
            $this->errors[] = 'Please Insert Password';
        }

        if (! $this->errors) {
            $loginModel = $this->load->model('Login');

            if (! $loginModel->isValidLogin($email, $password)) {
                $this->errors[] = 'Invalid Login Data';
            }
        }

        return empty($this->errors);
    }
}