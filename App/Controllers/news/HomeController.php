<?php

namespace App\Controllers\news;

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
        $data['posts'] = $this->load->model('Posts')->latest();

        $this->html->setTitle($this->settings->get('site_name'));

        $postController = $this->load->controller('news/Post');

        $data['post_box'] = function ($post) use ($postController) {
            return $postController->box($post);
        };
        $this->newsLayout->disable('sidebar');

        // i will use getOutput() method just to display errors
        // as i'm using php 7 which is throwing all errors as exceptions
        // which won't be thrown through the __toString() method
        $view = $this->view->render('news/home', $data);

        return $this->newsLayout->render($view);
    }
}