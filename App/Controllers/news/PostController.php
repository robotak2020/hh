<?php

namespace App\Controllers\news;

use System\Controller;

class PostController extends Controller
{
     /**
     * Display Post Page
     *
     * @param string name
     * @param int $id
     * @return mixed
     */
    public function index($title, $id)
    {
        $post = $this->load->model('Posts')->getPostWithComments($id);

        if (! $post) {
            return $this->url->redirectTo('/404');
        }
        $this->newsLayout->disable('sidebar');

        $this->html->setTitle($post->title);
        $data['categories'] = $this->load->model('Categories')->getEnabledCategoriesWithNumberOfTotalPosts();
        $data['post'] = $post;

        $view = $this->view->render('news/post', $data);

        return $this->newsLayout->render($view);
    }

     /**
     * Add New Comment to the given post
     *
     * @param string $title
     * @param int $id
     * @return mixed
     */
    public function addComment($title, $id)
    {
        // first we will check if there is no comment or the post does not exist
        // then we will redirect him to not found page
        $comment = $this->request->post('comment');

        $postsModel = $this->load->model('Posts');
        $loginModel = $this->load->model('Login');

        $post = $postsModel->get($id);

        if (! $post OR $post->status == 'disabled' OR ! $comment OR ! $loginModel->isLogged()) {
            return $this->url->redirectTo('/404');
        }

        $user = $loginModel->user();

        $postsModel->addNewComment($id, $comment, $user->id);

        return $this->url->redirectTo('/post/' . $title . '/' . $id . '#comments');
    }

     /**
     * Load the post box view for the given post
     *
     * @param \stdClass $post
     * @return string
     */
    public function box($post)
    {
        return $this->view->render('news/post-box', compact('post'));
    }
}