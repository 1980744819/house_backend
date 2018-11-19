<?php
/**
 * Created by PhpStorm.
 * User: 资霄
 * Date: 2018/9/18
 * Time: 19:14
 */

namespace app\index\model;


use think\Model;

class Location extends Model
{
    public static $lists=['name'];
    public static function create_item($data){
        $location=new Location();
        foreach (Location::$lists as $index=>$item){
            $location[$item]=$data[$item];
        }
        if($location->save()){
            return true;
        }
        return false;
    }
}