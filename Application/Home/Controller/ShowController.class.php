<?php
/**
 * Created by IntelliJ IDEA.
 * User: Felix
 * Date: 2016/4/11
 * Time: 21:30
 */

namespace Home\Controller;
use Think\Controller;
use Think\Model;
use Think\Page;

class ShowController extends CommonController
{

    public function index()
    {
        $departmentId = I('get.departmentId');
        $model2 = new Model();
        $select_Departments = "SELECT * FROM department WHERE id = $departmentId";
        $selectDepartments = $model2->query($select_Departments);
        $this->assign('selectDepartments', $selectDepartments);
        $this->assign('departmentId', $departmentId);
        $this->display();
    }

    public function show()
    {
        $departmentId = I('post.departmentId');

        $model = new Model();
        $select_allDepartments = "SELECT * FROM department";
        $allDepartments = $model->query($select_allDepartments);

        //$departmentId = empty($departmentId) ? $allDepartments[0]['id'] : $departmentId;

        $select_deptEmployees = "SELECT * FROM employee WHERE department_id = $departmentId AND status = 1 ORDER BY votes DESC";
        $allDeptEmployees = $model->query($select_deptEmployees);

        //$this->ajaxReturn($allDeptEmployees, 'data.json');
        //$this->display();
        $this->ajaxReturn($allDeptEmployees,'json',0);
    }
}