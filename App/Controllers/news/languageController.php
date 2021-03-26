<?php

namespace App\Controllers\news;

use System\Controller;

class languageController extends Controller
{
    /**
     * Display Home Page
     *
     * @return mixed
     */
    public function index($language,$id)
    {
        $languageModel = $this->load->model('language');
        if(in_array($language,$languageModel->get_languages())) {
            $this->session->set('lang', $language);
            return $this->url->redirectTo('/');
        }
        else {
            return $this->url->redirectTo('/');
        }
    }
}