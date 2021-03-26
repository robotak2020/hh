<?php


namespace App\Models;

use http\Client\Curl\User;
use System\Application;
use System\Model;
use Countable;

/**
 * Class CourseModel
 * @package App\Models
 */
class CourseModel extends Model
{
    /**
     * Table name
     * @var string
     */

    protected $table = 'course_tbl';


    /**
     * add a new course
     * @param $course_name
     * @return array
     */
    public function addNewcourse($course_name)
    {
        $user = $this->load->model('Login')->user();
        $course_name = strtoupper($course_name);
        $get_course = $this->select('*')->from($this->table)->where('cou_name=?',$course_name)->fetch();
        if ($get_course) {
            $res = array("res" => "exist", "course_name" => $course_name);

        }
        else{
            $insCourse = $this->data('cou_name', $course_name)
                ->data('cou_created', $now = time())
                ->insert($this->table);
            if($insCourse)
            {
                $res = array("res" => "success", "course_name" => $course_name);
            }
            else
            {
                $res = array("res" => "failed", "course_name" => $course_name);
            }


        }
        return $res;
    }


    /**
     * Get All courses
     * @return array
     */
    public function all()
    {
        return $this->orderBy('cou_id', 'DESC')->fetchAll($this->table);

    }

    /**
     * count all courses/programs made
     * @return mixed
     */
    public function count_all()
    {
        $all_courses = $this->select('COUNT(cou_id) as totCourse')->from($this->table);
        return $all_courses;
    }

    /**
     * delete course by id
     * @param $id
     * @return string[]
     */
    public function delete_courses($id)
    {
        $delCourse = $this->where('cou_id=?',$id)->delete($this->table);
        if($delCourse)
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
     * update course name
     * @param $newCourseName
     * @param $course_id
     * @return array|string[]
     */
    public function update_courses($newCourseName, $course_id)
    {
        $newCourseName = strtoupper($newCourseName);

        $updatecourses = $this->data('cou_name', $newCourseName)
            ->where('cou_id=?', $course_id)
            ->update($this->table);
        if($updatecourses)
        {
            $res = array("res" => "success", "newCourseName" => $newCourseName);
        }
        else
        {
            $res = array("res" => "failed");
        }
        return $res;
    }

}