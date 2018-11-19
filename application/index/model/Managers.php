<?php
/**
 * Created by PhpStorm.
 * User: 资霄
 * Date: 2018/8/17
 * Time: 22:28
 */

namespace app\index\model;

use think\Model;

class Managers extends Model
{
    public static $lists = ['school_id', 'username', 'password'];

    public static function getValidate($id, $password)
    {
        var_dump($id);
        if ($user = Managers::where('school_id', $id)->find() != null) {
            var_dump($user);
        }
        return false;
    }

    public static function change_item($data)
    {
        $user = Managers::get($data['id']);
        foreach (Managers::$lists as $item) {
            $user[$item] = $data[$item];
        }
        if ($user->save()) {
            return true;
        } else
            return false;
    }

    public static function create_item($data)
    {
        $user = new Managers();
        foreach (Managers::$lists as $item) {
            $user[$item] = $data[$item];
        }
        if ($user->save()) {
            return true;
        } else
            return false;
    }
}