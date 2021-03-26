<?php

namespace App\Controllers\news;

use System\Controller;

class AboutController extends Controller
{
    /**
     * Display Home Page
     *
     * @return mixed
     */
    public function index()
    {
        $this->html->setTitle('robotak-about_us');

        $view = $this->view->render('news/about');

        return $this->newsLayout->render($view);
    }
}