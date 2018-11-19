<?php
/**
 * Created by PhpStorm.
 * User: 资霄
 * Date: 2018/8/16
 * Time: 23:46
 */

namespace app\index\controller;


use app\index\model\Managers;
use think\Controller;
use think\Request;
use think\Session;

class Login extends Controller
{
    public function index(){
        return $this->fetch();
    }

    public function get_index()
    {
        $data=Request::instance()->post();
        $user=Managers::where('school_id',$data['id'])->where('password',$data['password'])->find();
        if($user!=null){
            Session::set('name',$user->username);
            Session::set('id',$user->id);
            return $this->success('welcome','index/index');
        }
        else{
            return $this->error('id or password not right','index');
        }
    }
}