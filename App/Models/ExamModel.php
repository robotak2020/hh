<?php


namespace App\Models;

use http\Client\Curl\User;
use System\Application;
use System\Model;
use Countable;

/**
 * Class ExamModel
 * @package App\Models
 */
class ExamModel extends Model
{
    /**
     * Table name
     * @var string
     */

    protected $table = 'exam_tbl';
    /**
     * exam questions table
     * @var string
     */
    protected $exam_question_tbl = 'exam_question_tbl';

    /**
     * exam awnsers table
     * @var string
     */
    protected $exam_answers = 'exam_answers';

    /**
     * users table
     * @var string
     */
    protected $examinee_tbl = 'users';

    /**
     * exam attempt
     * @var string
     */
    protected $exam_attempt = 'exam_attempt';


    /**
     * get the exams that is given to the user program (course)
     * @param $user_id
     * @return array
     */
    public function exams_by_user_id($user_id)
    {
        $user = $this->select('*')->where('id=?', $user_id)->fetch($this->examinee_tbl);

        if (! $user) return [];
        $exam = $this->select('*')->from($this->table)->where('cou_id=?', $user->exmne_course)->orderBy('ex_id', 'DESC')->fetchAll();

        return $exam;
    }


    /**
     * get the exam array from the database
     * @param $id
     * @return null
     */
    public function getexam($id)
    {
        $exam = $this->where('ex_id=?', $id)->fetch($this->table);

        if (!$exam) return null;

        return $exam;
    }

    /**
     * get the exam questions and limit them to the given limit
     * @param $exam_id
     * @return array
     */
    public function examquestions($exam_id)
    {
    $ex_questlimit_display = $this->getexam($exam_id)->ex_questlimit_display;
    $exam_questions = $this->where('exam_id=?', $exam_id)
        ->orderBy('rand()')
        ->limit($ex_questlimit_display)
        ->fetchAll($this->exam_question_tbl);
        if (! $exam_questions) return [];


        return $exam_questions;
    }
    /**
     * count exam questions
     * @param $exam_id
     * @return int
     */
    public function countexamquestions($exam_id)
    {
    $exam_questions = $this->where('exam_id=?', $exam_id)
        ->fetchAll($this->exam_question_tbl);
    $num_questions = count($exam_questions);
        return $num_questions;
    }


    /**
     * get the results in an array to view with questions
     * @param $exam_id
     * @param $examne_id
     * @return mixed
     */
    public function results($exam_id , $examne_id)
    {
        $questions_with_awnsers = $this->select('*')
            ->from('exam_question_tbl eqt')
            ->join('INNER JOIN exam_answers ea ON exam_question_tbl.eqt_id = ea.quest_id')
            ->where('exam_question_tbl.exam_id=? AND ea.axmne_id=? AND ea.exans_status=?', $exam_id, $examne_id, 'new')
            ->fetchAll('exam_question_tbl');
        return $questions_with_awnsers;
    }

    /**
     * get the score and put it in an array to view
     * @param $exam_id
     * @param $examne_id
     * @return array
     */
    public function score($exam_id , $examne_id)
    {
        $num_questions = $this->countexamquestions($exam_id);
        $questions_with_awnsers = $this->select('*')
            ->from('exam_question_tbl eqt')
            ->join('INNER JOIN exam_answers ea ON eqt.eqt_id = ea.quest_id')
            ->where('eqt.exam_id=? AND ea.axmne_id=? AND ea.exans_status=?', $exam_id, $examne_id, 'new')
            ->fetchAll();
        $count = 0;
        foreach ($questions_with_awnsers as $key => $qwa) {
            if ($questions_with_awnsers[$key]->exam_answer == $questions_with_awnsers[$key]->exans_answer) {
                $count++;
            }
        }
        $score = array(
            'count' => $count,
            'over' => $num_questions,
            'precentage' => round($count / $num_questions * 100)
        );
        return $score;
    }


    /**
     * check if there was an exam attempt made by user
     * @param $User_id
     * @param $exam_id
     * @return bool
     */
    public function has($User_id , $exam_id)
    {
        $examAttmpt = $this->where('exmne_id=? AND exam_id=?', $User_id , $exam_id)->fetch($this->exam_attempt);
        error_reporting(0);
        if ($examAttmpt) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * check if has been answered
     * @param $User_id
     * @param $exam_id
     * @return bool
     */
    public function hasawnsered($User_id , $exam_id)
    {
        $examAttmpt = $this->where('axmne_id=? AND exam_id=?', $User_id , $exam_id)->fetch($this->exam_answers);

        if ($examAttmpt) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * submit the exam awners in a string text imploded and return success if worked
     * @param $user_id
     * @param $exam_id
     * @param $answers
     * @return string[]
     */
    public function submit_exam($user_id , $exam_id , $answers)
    {
        if ($this->has($user_id,$exam_id)) {
            $res = array("res" => "alreadyTaken");

        } else if (! $this->hasawnsered($user_id,$exam_id)) {
            $this->update($user_id, $exam_id);
            foreach ($answers as $key => $value) {
                array_push($keys, $key);
                array_push($values, $value);
            }
            $questionkey = implode(",.", $keys);
            $questionvalue = implode(",.", $values);
            $submit_awnsers = $this->data('axmne_id', $user_id)
                ->data('exam_id', $exam_id)
                ->data('quest_id', $questionkey)
                ->data('exans_answer', $questionvalue)
                ->data('created', $now = time())
                ->insert($this->exam_answers);
            if ($submit_awnsers) {
                $attempt = $this->update_attempt($user_id, $exam_id);
                if($attempt)
                {
                    $res = array("res" => "success");
                }
                else
                {
                    $res = array("res" => "failed");
                }

            }
            else
            {
                $res = array("res" => "failed");

            }

        }
        else {
            foreach ($answers as $key => $value) {
                array_push($keys, $key);
                array_push($values, $value);
            }
            $questionkey = implode(",.", $keys);
            $questionvalue = implode(",.", $values);
            $submit_awnsers = $this->data('axmne_id', $user_id)
                ->data('exam_id', $exam_id)
                ->data('quest_id', $questionkey)
                ->data('exans_answer', $questionvalue)
                ->data('created', $now = time())
                ->insert($this->exam_answers);
            if ($submit_awnsers) {
                $attempt = $this->update_attempt($user_id, $exam_id);
                if($attempt)
                {
                    $res = array("res" => "success");
                }
                else
                {
                    $res = array("res" => "failed");
                }

            }
            else
            {
                $res = array("res" => "failed");

            }
        }
        return $res;
    }

    /**
     * update the exam answer status
     * @param $User_id
     * @param $exam_id
     */
    public function update($User_id , $exam_id)
    {
        $this->data('exans_status', 'old')
            ->where('axmne_id=?,exam_id=?',$User_id,$exam_id)
            ->update($this->exam_answers);
    }

    /**
     * update the attempt status to the user
     * @param $User_id
     * @param $exam_id
     * @return mixed
     */
    public function update_attempt($User_id , $exam_id)
    {
        return $this->data('exmne_id', $User_id)
            ->data('exam_id', $exam_id)
            ->insert($this->exam_attempt);
    }

    /**
     * find the exam id and data using only its title
     * @param $exam_title
     * @return mixed
     */
    public function getexambytitle($exam_title)
    {
        return $this->select('*')->from($this->table)->where('ex_title=?', $exam_title)->fetch();
    }

    /**
     * check all data have been added correctly and inset exam to database
     * @param $cou_id
     * @param $ex_title
     * @param $ex_time_limit
     * @param $ex_questlimit_display
     * @param $ex_description
     * @return array
     */
    public function insert_exam($cou_id, $ex_title, $ex_time_limit, $ex_questlimit_display, $ex_description)
    {
        if($cou_id == "0" || $cou_id = null )
        {
            $res = array("res" => "noSelectedCourse");
        }
        else if($ex_time_limit == "0" || $ex_time_limit = null)
        {
            $res = array("res" => "noSelectedTime");
        }
        else if($ex_questlimit_display == "" && $ex_questlimit_display == null)
        {
            $res = array("res" => "noDisplayLimit");
        }
        else if($this->getexambytitle($ex_title))
        {
            $res = array("res" => "exist", "examTitle" => $ex_title);
        }
        else {
            $insert_exam = $this->data('cou_id', $cou_id)
                ->data('ex_title', $ex_title)
                ->data('ex_time_limit', $ex_time_limit)
                ->data('ex_questlimit_display', $ex_questlimit_display)
                ->data('ex_description', $ex_description)
                ->insert($this->table);
            if ($insert_exam) {
                $res = array("res" => "success", "examTitle" => $ex_title);
            } else {
                $res = array("res" => "failed", "examTitle" => $ex_title);
            }
        }
        return $res;
    }

    /**
     * check if question exists and insert it
     * @param $exam_id
     * @param $exam_question
     * @param $choice_A
     * @param $choice_B
     * @param $choice_C
     * @param $choice_D
     * @param $exam_answer
     * @return array|string[]
     */
    public function insert_question($exam_id, $exam_question, $choice_A, $choice_B, $choice_C, $choice_D, $exam_answer)
    {
        $check_question = $this->select('*')->from($this->exam_question_tbl)->where('exam_id=?,exam_question=?', $exam_id, $exam_question)->fetch($this->exam_question_tbl);
        if ($check_question) {
            $res = array("res" => "exist", "msg" => $exam_question);
        } else {
            $insert_question = $this->data('exam_id', $exam_id)
                ->data('exam_question', $exam_question)
                ->data('exam_ch1', $choice_A)
                ->data('exam_ch2', $choice_B)
                ->data('exam_ch3', $choice_C)
                ->data('exam_ch4', $choice_D)
                ->data('exam_answer', $exam_answer);
            if($insert_question)
            {
                $res = array("res" => "success", "msg" => $exam_question);
            }
            else
            {
                $res = array("res" => "failed");
            }

        }
        return $res;
    }

    /**
     * count all exams made
     * @return mixed
     */
    public function count_all()
    {
        $all_exams = $this->select('COUNT(ex_id) as totExam')->from($this->table);
        return $all_exams;
    }

    /**
     * delete exams from the database using id
     * @param $id
     * @return string[]
     */
    public function delete_exams($id)
    {
        $delExam = $this->where('ex_id=?',$id)->delete($this->table);
        if($delExam)
        {
            $res = array("res" => "success");
        }
        else
        {
            $res = array("res" => "failed");
        }
        return $res;
    }

    /**
     * delete questions from questions table
     * @param $id
     * @return string[]
     */
    public function delete_questions($id)
    {
        $delete_questions = $this->where('eqt_id=?',$id)->delete($this->exam_question_tbl);
        if($delete_questions)
        {
            $res = array("res" => "success");
        }
        else
        {
            $res = array("res" => "failed");
        }
        return $res;
    }

    /**
     * update/change an exam
     * @param $examTitle
     * @param $course_id
     * @param $examLimit
     * @param $examQuestDipLimit
     * @param $examDesc
     * @param $examId
     * @return array|string[]
     */
    public function update_exams($course_id, $examTitle, $examLimit, $examQuestDipLimit, $examDesc, $examId)
    {

        $updatecourses = $this->data('cou_id', $course_id)
            ->data('ex_title', $examTitle)
            ->data('ex_time_limit', $examLimit)
            ->data('ex_questlimit_display', $examQuestDipLimit)
            ->data('ex_description', $examDesc)
            ->where('ex_id=?', $examId)
            ->update($this->table);
        if($updatecourses)
        {
            $res = array("res" => "success", "msg" => $examTitle);
        }
        else
        {
            $res = array("res" => "failed");
        }
        return $res;
    }

    /**
     * update a question from database
     * @param $question
     * @param $exam_ch1
     * @param $exam_ch2
     * @param $exam_ch3
     * @param $exam_ch4
     * @param $question_id
     * @return string[]
     */
    public function update_questions($question, $exam_ch1, $exam_ch2, $exam_ch3, $exam_ch4, $question_id)
    {

        $updatecourses = $this->data('exam_question', $question)
            ->data('exam_ch1', $exam_ch1)
            ->data('exam_ch2', $exam_ch2)
            ->data('exam_ch3', $exam_ch3)
            ->data('exam_ch4', $exam_ch4)
            ->where('eqt_id=?', $question_id)
            ->update($this->exam_question_tbl);
        if($updatecourses)
        {
            $res = array("res" => "success");

        }
        else
        {
            $res = array("res" => "failed");
        }
        return $res;
    }

    /**
     * Add New Comment/feedback
     * @param string $comment
     * @param int $userId
     * @return bool
     */
    public function addNewComment( $comment, $userId)
    {
        $date = date("F d, Y");

        return $this->data('exmne_id', $userId)
            ->data('fb_exmne_as', $userId)
            ->data('fb_feedbacks', $comment)
            ->data('fb_date', $date)
            ->insert('feedbacks_tbl');
    }

    /**
     * show feedbacks for a user
     * @param $user_id
     * @return mixed
     */
    public function show_feedback($user_id)
    {
        return $this->select('feedbacks_tbl.*')->from('feedbacks_tbl')->where('exmne_id=?', $user_id)->fetch('feedbacks_tbl');
    }
}