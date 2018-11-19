<?php
/**
 * Created by PhpStorm.
 * User: 资霄
 * Date: 2018/9/18
 * Time: 18:39
 */

namespace app\index\model;


use think\Model;

class Title extends Model
{
    public static $lists = ['content'];

    public static function create_item($data)
    {
        $title = new Title();
        foreach (Title::$lists as $index => $item) {
            $title[$item] = $data[$item];
        }
        if ($title->save()) {
            return true;
        }
        return false;
    }
}