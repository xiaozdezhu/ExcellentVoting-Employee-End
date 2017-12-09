<?php
/**
 * Created by IntelliJ IDEA.
 * Date: 2016/4/11
 * Time: 21:30
 */

namespace Home\Controller;
use Think\Controller;
use Think\Model;
use Think\Page;

class MapController extends CommonController
{

    public function index()
    {
        $this->display();
    }

    public function show()
    {

        $model = new Model();
        $sql = "SELECT * ,count(*) AS count FROM record group by cityName";
        $rs = $model->query($sql);
        $result = array();
        for($i = 0;$i < count($rs);$i++){
          array_push($result,array('name' => $rs[$i]['cityName'], 'value' => $rs[$i]['count']));
        }

        $this->ajaxReturn($result,'json',0);
    }
}