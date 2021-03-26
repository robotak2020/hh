<?php

namespace App\Controllers\news;

use System\Controller;

class TeamController extends Controller
{
    /**
     * Display Home Page
     *
     * @return mixed
     */
    public function index()
    {
        $this->html->setTitle('robotak-about_us');
        $this->newsLayout->disable('sidebar');

        $view = $this->view->render('news/team');

        return $this->newsLayout->render($view);
    }
}