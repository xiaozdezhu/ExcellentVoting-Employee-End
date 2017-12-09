<?php
/**
 * Created by IntelliJ IDEA.
 * User: Felix
 * Date: 2016/4/17
 * Time: 10:53
 */

namespace Home\Controller;
use Think\Controller;


class CommonController extends Controller
{
    public static $userid = '';

    /**
     * 自动执行
     */
    public function _initialize()
    {
        // 判断用户是否登录
        if (session('id')) {
            $this->userid = session('id');
        } else {
            $this->error('对不起,您还没有登录,正跳转至登录面...', U('Login/login'));
        }
    }
}