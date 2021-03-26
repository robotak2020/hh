<?php

namespace App\Controllers\news\Common;

use System\Controller;

class SidebarController extends Controller
{
    public function index()
    {
        $data['categories'] = $this->load->model('Categories')->getEnabledCategoriesWithNumberOfTotalPosts();


        return $this->view->render('news/common/sidebar', $data);
    }
}