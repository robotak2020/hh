<?php

namespace App\Controllers\news;

use System\Controller;

class BlogController extends Controller
{
     /**
     * Display Home Page
     *
     * @return mixed
     */
    public function index()
    {
        $posts = $this->load->model('Posts')->latest_paginatied();
        $data['posts'] = $posts;
        $this->newsLayout->disable('sidebar');
        $this->html->setTitle($this->settings->get('site_name'));
        if ($posts) {
            $posts = array_chunk($posts, 2);
        } else {
            if ($this->pagination->page() != 1) {
                // then just redirect him to the first page of the category
                // regardless there is posts or not in that category
                return $this->url->redirectTo("/blog");
            }
        }
        $postController = $this->load->controller('news/Post');


        $data['post_box'] = function ($post) use ($postController) {
            return $postController->box($post);
        };

        // i will use getOutput() method just to display errors
        // as i'm using php 7 which is throwing all errors as exceptions
        // which won't be thrown through the __toString() method
        $data['url'] = $this->url->link('/blog'.'?page=');
        $data['pagination'] = $this->pagination->paginate();
        $view = $this->view->render('news/blog', $data);


        return $this->newsLayout->render($view);
    }
}