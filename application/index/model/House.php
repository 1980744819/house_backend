<?php
/**
 * Created by PhpStorm.
 * User: 资霄
 * Date: 2018/8/18
 * Time: 11:47
 */

namespace app\index\model;


use app\index\controller\Index;
use think\Model;

class House extends Model
{
    public static $lists = ['location', 'name', 'structure', 'covered_area', 'use_area', 'user_name', 'price', 'decorate', 'status', 'title', 'belong_to', 'check_in_time', 'leave_time', 'contract_id', 'floor', 'direction', 'pay_price', 'get_money', 'get_money_time', 'remark'];

    public static function change_item($data)
    {
        $house = House::get($data['id']);
        foreach (Index::$lists as $str){
            $house[$str]=$data[$str];
        }
        if($house->save()){
            return true;
        }
        else
            return false;
    }
    public static function create_item($data)
    {
        $house=new House();
        foreach (Index::$lists as $str){
            $house[$str]=$data[$str];
        }
        if($house->save()){
            return true;
        }
        else
            return false;
    }
}