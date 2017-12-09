<?php

namespace Home\Model;
use Think\Model;

class RecordModel extends Model {

    // 重新定义表
    protected $tableName = 'record';
    /**
     * 自动验证
     * self::EXISTS_VALIDATE 或者0 存在字段就验证（默认）
     * self::MUST_VALIDATE 或者1 必须验证
     * self::VALUE_VALIDATE或者2 值不为空的时候验证
     */


     /**
     * 自动完成
     */
    protected $_auto = array (
        array('time','getTime',1,'callback'),
    );

    protected function getTime(){
        return date("Y-m-d H:i:s");
    }

     /**
      * 获取ip地址
     */
     public function getIPLoc_sina($queryIP){
         $url = 'http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json&ip='.$queryIP;
         $ch = curl_init($url);
         //curl_setopt($ch,CURLOPT_ENCODING ,'utf8');
         curl_setopt($ch, CURLOPT_TIMEOUT, 5);
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ; // 获取数据返回
         $location = curl_exec($ch);
         $location = json_decode($location);
         curl_close($ch);

         $loc = "";
         if($location===FALSE) return "";
         if (empty($location->desc)) {
             $loc = $location->province.$location->city.$location->district.$location->isp;
         }else{
             $loc = $location->desc;
         }
         $loc = mb_substr($loc,2,2,"utf-8");
         return $loc;
     }


}