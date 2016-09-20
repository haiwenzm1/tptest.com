<?php

namespace Admin\Logic;
use Think\Model;

class GroupLogic extends Model {
    public function getAllInfo(){
        $result = D('Group')->getAllInfo();
        $tmp = get_array($result);
        return $tmp;
    }

    public function getInfoById($data){
        $id = $data['id'];
        $result = D('Group')->getInfoById($id);
        $tmp = D('Group')->getPinfoByPid($result[0]['pid']); 
        $result[0]['pname'] = $tmp[0]['name'];
        return $result;
    }

    public function addInfo($data){
        $result = D('Group')->getRoleidById($data['pid']);
        if($result[0]['roleid']){
            $datas = array();
            $datas['pid'] = $data['pid'];
            $datas['name'] = $data['name'];
            $datas['is_last'] = $data['last'];
            $datas['description'] = $data['description'];
            $datas['create_time'] = time();
            $datas['update_time'] = $datas['create_time'];
            $datas['roleid'] = $result[0]['roleid'];
            
            $result = D('Group')->addInfo($datas);
            return $result;
        }else{
            return false;
        }   
    }
}