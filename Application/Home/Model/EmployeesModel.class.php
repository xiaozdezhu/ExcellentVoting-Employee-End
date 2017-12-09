<?php

namespace Home\Model;
use Think\Model;

class EmployeesModel extends Model {

    // 重新定义表
    protected $tableName = 'employee';
    /**
     * 自动验证
     * self::EXISTS_VALIDATE 或者0 存在字段就验证（默认）
     * self::MUST_VALIDATE 或者1 必须验证
     * self::VALUE_VALIDATE或者2 值不为空的时候验证
     */
    protected $_validate = array(
        array('name', 'require', '用户名不能为空！'), //默认情况下用正则进行验证
        array('realname', 'require', '真实姓名不能为空！'), //默认情况下用正则进行验证
        array('department_id','require','部门id不能为空！', 2, 'checkDepId'),
        array('position', 'require', '职位不能为空！'), //默认情况下用正则进行验证
        array('description', 'require', '描述不能为空！'), //默认情况下用正则进行验证
    );

    /**
     * 自动完成
     */
    protected $_auto = array (
        //array('password', 'md5', 3, 'function') , // 对password字段在新增和编辑的时候使md5函数处理
    );

    protected function checkDepId()
    {
        // 获取POST数据
        //$agree = I('post.agree', 0, 'intval');

        $depId = I('post.departmentId');

        if($depId <= 0 || $depId > 7){
            return false;
        }else{
            return true;
        }

    }
}