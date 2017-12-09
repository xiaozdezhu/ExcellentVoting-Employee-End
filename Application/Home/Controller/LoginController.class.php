<?php

namespace Home\Controller;
use Think\Controller;
use Think\Model;

class LoginController extends Controller {

    public function index(){

        $this->display();
    }

    /**
     * 用户登录
     */
    public function login()
    {
        // 判断提交方式
        if (IS_POST) {
            // 实例化Login对象
            $login = D('login');

            // 自动验证 创建数据集
            if (!$data = $login->create()) {
                // 防止输出中文乱码
                header("Content-type: text/html; charset=utf-8");
                exit($login->getError());
            }

            // 组合查询条件
            $where = array();
            $where['username'] = $data['username'];
            $result = $login->where($where)->field('userId,username,departmentId,realname,password')->find();

            // 验证用户名 对比 密码
            if ($result && $result['password'] == $data['password']) {
                // 存储session
                session('id', $result['userId']);                // 当前用户id
                session('realname', $result['realname']);   // 当前用户真实名
                session('username', $result['username']);   // 当前用户名
                session('departmentId', $result['departmentId']);  //当前用户的部门

                // 更新用户登录信息
                $where['userid'] = session('id');
                //M('users')->where($where)->setInc('loginnum');   // 登录次数加 1
                //M('users')->where($where)->save($data);   // 更新登录时间和登录ip

                $this->success('登录成功,正跳转至系统首页...', U('Index/index'));
            } else {
                $this->error('登录失败,用户名或密码不正确!');
            }
        } else {
            $this->display();
        }
    }

    /**
     * 用户注册
     */
    public function register()
    {
        // 判断提交方式 做不同处理
        if (IS_POST) {
            
            // 实例化User对象
            $user = D('users');

            // 自动验证 创建数据集
            if (!$data = $user->create()) {
                // 防止输出中文乱码
                header("Content-type: text/html; charset=utf-8");
                exit($user->getError());
            }

            //插入数据库
            if ($id = $user->add($data)) {
                $this->success('注册成功',U('Login/login'));
            } else {
                $this->error('注册失败');
            }
        } else {
            $this->display();
        }
    }

    /**
     * 用户注销
     */
    public function logout()
    {
        // 清楚所有session
        session(null);
        redirect(U('Login/login'));
    }
    
//    public function login(){
//        $Model = M('User');
//        $Username = I('post.username');
//        $Password = I('post.password');
//        $select_user = "SELECT * FROM user WHERE name = $Username AND password = $Password";
//        //$rightUser = $Model->query($select_user);
//        $result = $Model ->execute($select_user);
//
//        if($result == 0){
//
//        }else{
//            $this->display();
//        }
//    }
}

