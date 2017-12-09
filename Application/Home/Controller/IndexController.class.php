<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
use Think\Model;
use Think\Page;

class IndexController extends CommonController {

    public function index(){

        $departmentId = I('get.departmentId');
        $pn = I('get.p', 1, 'int');
        $ps = C('PAGE_SIZE_20');

        $model = new Model();
        $select_allDepartments = "SELECT * FROM department";
        $allDepartments = $model->query($select_allDepartments);

        $departmentId = empty($departmentId) ? $allDepartments[0]['id'] : $departmentId;

        $start = ($pn - 1)*$ps;

        $select_deptEmployees = "SELECT * FROM employee WHERE department_id = $departmentId AND status = 1 ORDER BY votes DESC LIMIT $start, $ps";
        $allDeptEmployees = $model->query($select_deptEmployees);

        //$total = $model->query("SELECT COUNT(id) AS count FROM employee WHERE department_id = $departmentId")[0]['count'];
        //$total = $model->query("SELECT COUNT(id) AS count FROM employee WHERE department_id = $departmentId");

        $employeeW = array(
            'department_id' => $departmentId,
        );
        $total = $model->where($employeeW)->count();

        $page  = new Page($total, $ps);
        $pageShow = $page->show();

        $this->assign('departmentId', $departmentId);
        $this->assign('pageShow', $pageShow);
        $this->assign('departmentList', $allDepartments);
        $this->assign('employeeList', $allDeptEmployees);
        $this->assign('avatarUrlPrefix', C('AVATAR_URL_PREFIX'));
        $this->display();
    }

     /**
     * 判断是否还能投票
     */
    public function judge(){
        $limitCount = C('VOTE_LIMIT_COUNT');
        $ip = $_SERVER["REMOTE_ADDR"];
        $departmentId = I('post.departmentId');
        $model = new Model();
        $select_allDepartments = "SELECT * FROM department";
        $allDepartments = $model->query($select_allDepartments);
        $departmentId = empty($departmentId) ? $allDepartments[0][id] : $departmentId;

//        cookie('departmentId', null);

        $deptIds = cookie('departmentId');
        $deptIds = empty($deptIds) ? array() : json_decode($deptIds,true);
        if(!empty($deptIds[$departmentId][$ip]) && $deptIds[$departmentId][$ip] >= $limitCount){
            $result = array(
                'flag' => 'fail',
                'msg' => C('VOTE_FAIL_MSG'),
            );
            $this->ajaxReturn($result, 'json');
        }
        else{
            $result = array(
                'flag' => 'success',
            );
            $this->ajaxReturn($result, 'json');exit;
        }
    }


    /**
     * 投票
     * 每人每个城市一天10票
     */
    public function vote(){

        $ip = $_SERVER["REMOTE_ADDR"];
        $departmentId = I('post.departmentId');
        $model = new Model();
        $select_allDepartments = "SELECT * FROM department";
        $allDepartments = $model->query($select_allDepartments);
        $departmentId = empty($departmentId) ? $allDepartments[0][id] : $departmentId;

        $employeeId = I('post.employeeId');

        //cookie('departmentId', null);

        $deptIds = cookie('departmentId');
        $deptIds = empty($deptIds) ? array() : json_decode($deptIds,true);

        if(!empty($deptIds[$departmentId][$ip])) {
            $deptIds[$departmentId][$ip] += 1;
        } else {
            $deptIds[$departmentId][$ip] = 1;
        }


        $record = D("record");
        $record->create();
        $record->ip =  $ip;
        $record->userId = session('id');
        $record->employeeId = $employeeId;
        $loc = $record->getIPLoc_sina($ip);
        $record->cityName = $loc;
        $record->add();


        $y = date("y");
        $m = date("m");
        $d = date("d");
        $dayEnd= mktime(23,59,59,$m,$d,$y);
        cookie('departmentId', json_encode($deptIds), ($dayEnd-time()));

        $voteRes = M('employee')->where(array('id'=>$employeeId))->setInc('votes',1);
        if($voteRes) {
            $result = array(
                'flag' => 'success',
                'msg' => C('VOTE_SUCCESS_MSG'),
            );
            $this->ajaxReturn($result, 'json');
        } else {
            $result = array(
                'flag' => 'fail',
                'msg' => C('VOTE_ERROR_MSG'),
            );
            $this->ajaxReturn($result, 'json');exit;
        }
    }

    /**
     * 获取网址二维码
     */
    /*public function getQrCode(){
        vendor('phpqrcode.phpqrcode');
        $qrTools = new \QRcode();
        $errorCorrectionLevel = "L";
        $matrixPointSize = "8";
        $margin="1";
        $value = "http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'];
        $qrCode = $qrTools::png($value, false, $errorCorrectionLevel, $matrixPointSize,$margin);
        $this->ajaxReturn(array('flag'=>'success','qrCode'=>$qrCode),'text');
    }*/
}