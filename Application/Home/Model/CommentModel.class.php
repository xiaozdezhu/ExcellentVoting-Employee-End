<?php

namespace Home\Model;
use Think\Model;

class CommentModel extends Model {

    // 重新定义表
    protected $tableName = 'comment';
    /**
     * 自动验证
     * self::EXISTS_VALIDATE 或者0 存在字段就验证（默认）
     * self::MUST_VALIDATE 或者1 必须验证
     * self::VALUE_VALIDATE或者2 值不为空的时候验证
     */
    protected $_validate = array(
        array('content', 'require', '评论不能为空！'),
    );

    /**
     * 自动完成
     */
    protected $_auto = array (
        //array('time','time',self::MODEL_INSERT,'function'),
        array('time','getTime',1,'callback'),
        //array('userId','getId',1,'callback'),
        //array('password', 'md5', 3, 'function') , // 对password字段在新增和编辑的时候使md5函数处理
    );

    protected function getTime(){
        return date("Y-m-d H:i:s");
    }

    //protected function getId(){
        //return session('id');
    //}

}