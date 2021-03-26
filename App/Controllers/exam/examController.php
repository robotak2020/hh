<?php

namespace App\Controllers\exam;

use System\Controller;

class examController extends Controller
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
        $loginModel = $this->load->model('Login');
        $user = $loginModel->user();
        $user_id = $user->id;
        $check = $this->load->model('Exam')->has($user_id,$id);
        if ($check) {
            return $this->has($title,$id);
        }
        $examModel = $this->load->model('Exam');

        $exam = $examModel->getexam($id);

        $questions = $examModel->examquestions($id);

        $data['exam'] = $exam;

        $data['questions'] = $questions;

        $view = $this->view->render('exam/exam', $data);

        return $this->examLayout->render($view);
    }

    /**
     * Add New Comment to the given post
     * @return mixed
     */
    public function addComment()
    {
        // first we will check if there is no comment or the post does not exist
        // then we will redirect him to not found page
        $comment = $this->request->post('comment');

        $postsModel = $this->load->model('Posts');
        $loginModel = $this->load->model('Login');

        $user = $loginModel->user();

        $postsModel->addNewComment( $comment, $user->id);

        return $this->url->redirectTo('/');
    }

    public function submit($exam_title,$exam_id)
    {
        $loginModel = $this->load->model('Login');

        if ($loginModel->isLogged()) {

            $user = $loginModel->user();
            $user_id = $user->id;
//            $awnsers = $_REQUEST['answer'];
            $examModel = $this->load->model('exam');
            $questions = $examModel->examquestions($exam_id);
            $answers = array();
            foreach ($questions as $question) {
                array_push($this->request->post('answer['.$question->quest_id.'][correct]'), $answers);
            }
            return $this->json($examModel->submit_exam($user_id, $exam_id, $answers));
        } else {
            return $this->url->redirectTo('/login');

        }
    }

    public function has($title,$exam_id)
    {
        $loginModel = $this->load->model('Login');
        $user = $loginModel->user();
        $user_id = $user->id;
        $has = $this->load->model('exam')->has($user_id, $exam_id);
        if($has)
        {
            $res = array("res" => "alreadyExam", "msg" => $exam_id);
        }
        else
        {
            $res = array("res" => "takeNow");
        }


        return $this->json($res);
    }

    public function result($title,$exam_id)
    {
        $loginModel = $this->load->model('Login');

        $user = $loginModel->user();

        $user_id = $user->id;

        $exam_result = $this->load->model('exam')->result($exam_id,$user_id);

        $exam_score = $this->load->model('exam')->score($exam_id,$user_id);

        $data['exam_result'] = $exam_result;

        $data['exam_score'] = $exam_score;

        $view = $this->view->render('exam/result', $data);

        return $this->examLayout->render($view);
    }
    /**
     * Load the post box view for the given post
     *
     * @param \stdClass $post
     * @return string
     */
    public function box($post)
    {
        return $this->view->render('exam/post-box', compact('post'));
    }
}