<?php

namespace Home\Controller;
use Think\Controller;
use Think\Model;
use Think\Page;

class ValidateController extends CommonController
{
    public function index()
    {
        session_start();
        $_vc = new \Home\Model\ValidateCodeModel();		//实例化一个对象
        $_vc->doimg();
        $_SESSION['authnum_session'] = $_vc->getCode();//验证码保存到SESSION中

    }
    public function getCode()
    {
        $result = array(
            'sessionCode' => $_SESSION['authnum_session'],
        );
        $this->ajaxReturn($result, 'json');exit;
    }
}
