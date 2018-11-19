<?php
/**
 * Created by PhpStorm.
 * User: 资霄
 * Date: 2018/9/18
 * Time: 19:34
 */

namespace app\index\model;


use think\Model;

class Belongto extends Model
{
    public static $lists = ['name'];

    public static function create_item($data)
    {
        $title = new Belongto();
        foreach (Belongto::$lists as $index => $item) {
            $title[$item] = $data[$item];
        }
        if ($title->save()) {
            return true;
        }
        return false;
    }
}