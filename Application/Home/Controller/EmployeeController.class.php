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

class EmployeeController extends CommonController
{
    public function index()
    {
        if(IS_POST){
            $comment = D('comment');

            if(!$data = $comment->create()){
                header("Content-type: text/html; charset=utf-8");
                exit($comment->getError());
            }

            //插入数据库
            if ($id = $comment->add($data)) {
                $this->success('评论成功');
            } else {
                $this->error('评论失败');
            }
        }else{
            $employeeId = I('get.employeeId');
            $departmentId = I('get.departmentId');

            $model = new Model();
            $select_employee = "SELECT * FROM employee WHERE id = $employeeId";
            $selectEmployee = $model->query($select_employee);

            $model2 = new Model();
            $select_Departments = "SELECT * FROM department WHERE id = $departmentId";
            $selectDepartments = $model2->query($select_Departments);

            $model3 = new Model();
            $select_Comment = "SELECT * FROM comment WHERE employeeId = $employeeId ORDER BY time" ;
            $selectComments = $model3->query($select_Comment);

            $model4 = new Model();
            $user_List = "SELECT * FROM user";
            $userList = $model->query($user_List);

            $this->assign('commentList',$selectComments);
            $this->assign('selectDepartments', $selectDepartments);
            $this->assign('departmentId', $departmentId);
            $this->assign('selectEmployee', $selectEmployee);
            $this->assign('userList', $userList);
            $this->assign('avatarUrlPrefix', C('AVATAR_URL_PREFIX'));
            $this->display();
        }
    }

    public function info(){
        $this->display();
    }

    public function del(){
        $comment = M('comment');
        $commentId = I('post.commentId');
        $dataRes = $comment->where(array('id'=>$commentId))->delete();
        if($dataRes){
            $result = array(
                'flag' => 'success',
                'msg' => '删除成功',
            );
            $this->ajaxReturn($result, 'json');

        }else{
            $result = array(
                'flag' => 'fail',
                'msg' => '删除失败',
            );
            $this->ajaxReturn($result, 'json');exit;

        }
    }

    public function signup(){
        // 判断提交方式 做不同处理
        if (IS_POST) {
            //$this->success('hah',U('Index/index'));
            // 实例化User对象
            $user = D('employees');

            // 自动验证 创建数据集
            if (!$data = $user->create()) {
                header("Content-type: text/html; charset=utf-8");
                exit($user->getError());
            }

            //插入数据库
            if ($id = $user->add($data)) {
                $this->success('报名成功',U('Index/index'));
            } else {
                $this->error('报名失败');
            }
        } else {
            $this->display();
        }
    }
}