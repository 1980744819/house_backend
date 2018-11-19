<?php

namespace app\index\controller;

use app\index\model\Belongto;
use app\index\model\House;
use app\index\model\Location;
use app\index\model\Managers;
use app\index\model\Title;
use app\index\util\Tranlate;
use think\Controller;
use think\Db;
use think\Exception;
use think\exception\ErrorException;
use think\Request;
use think\Session;

require 'vendor/autoload.php';

class Index extends Validate
{
    public static $lists = ['location', 'name', 'structure', 'covered_area', 'use_area', 'user_name', 'price', 'decorate', 'status', 'title', 'belong_to','phone_number', 'check_in_time', 'leave_time', 'contract_id', 'floor', 'direction', 'pay_price', 'get_money', 'get_money_time', 'remark'];

    public function index()
    {
//        return '<style type="text/css">*{ padding: 0; margin: 0; } .think_default_text{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p> ThinkPHP V5<br/><span style="font-size:30px">十年磨一剑 - 为API开发设计的高性能框架</span></p><span style="font-size:22px;">[ V5.0 版本由 <a href="http://www.qiniu.com" target="qiniu">七牛云</a> 独家赞助发布 ]</span></div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_bd568ce7058a1091"></thinkad>';
        return $this->fetch();
    }

    public function login()
    {
        return $this->fetch();
    }

    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    public function sign_out()
    {
        Session::destroy();
        $this->redirect('login/index');
    }

    public function users()
    {
        $users = Managers::all();
        $this->assign('users', $users);
        return $this->fetch();
    }

    public function house()
    {
        $houses = House::all();
        foreach ($houses as $index => $item){
            $houses[$index]=Tranlate::get_show($item);
        }
        $this->assign('houses', $houses);
        return $this->fetch();
    }

    public function change()
    {
//        $house=House::get('3');
//        return $house;
        $data = Request::instance()->post();
        $data=Tranlate::get_save($data);
//        return $data;
        if ($data['id'] === "") {
            if (House::create_item($data)) {
                return 'success';

            } else
                return false;
        } else {
            return House::update($data);
        }
    }

    public function delete()
    {
        $data = Request::instance()->post();
        if ($data['id'] === "") {
            return "error";
        }
        $house = House::get($data['id']);
        if ($house->delete()) {
            return $this->success();
        } else {
            return false;
        }
    }

    public function change_user()
    {
        $data = Request::instance()->post();
//        return $data['id'];
        if ($data['id'] === "") {
            if (Managers::create_item($data)) {
                return "success";
            } else
                return false;
        } else {
            return Managers::update($data);
        }
    }

    public function delete_user()
    {
        $data = Request::instance()->post();
//        return $data;
        $user = Managers::get($data['id']);
        if ($user->delete()) {
            return "success";
        } else
            return "error";
    }

    public function excel_input()
    {
//        $a= dir('/static/excel');
        $path = "D:/wamp64/www/rh/public/static/excel/test.xlsx";
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
        $reader->setReadDataOnly(true);
        $spreadsheet = $reader->load($path);
        $worksheet = $spreadsheet->getActiveSheet();
        $highestRow = $worksheet->getHighestRow(); // 总行数
        $highestColumn = $worksheet->getHighestColumn();
        $lines = $highestColumn - 1;
        for ($row = 2; $row <= $highestRow; $row++) {
            $house = new House();
            foreach (Index::$lists as $index => $item) {
                $house[$item] = $worksheet->getCellByColumnAndRow($index + 1, $row)->getValue();
            }
            $house=Tranlate::get_save($house);
            var_dump($house);
            if ($house->save()) {
                echo "success";
            }
            echo "false";
        }
        return $this->success('index/house');
    }
    public function show_excel(){
        $path = "D:/wamp64/www/rh/public/static/excel/test.xlsx";
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
        $reader->setReadDataOnly(true);
        $spreadsheet = $reader->load($path);
        $worksheet = $spreadsheet->getActiveSheet();
        $highestRow = $worksheet->getHighestRow(); // 总行数
        $highestColumn = $worksheet->getHighestColumn();
        $lines = $highestColumn - 1;
        $houses=[];
        for ($row = 2; $row <= $highestRow; $row++) {
            $house=[];
            foreach (Index::$lists as $index => $item) {
                $house[$item] = $worksheet->getCellByColumnAndRow($index + 1, $row)->getValue();
            }
            array_push($houses,$house);
        }
        $this->assign('houses', $houses);
        return $this->fetch();
    }

    public function insert_house_item()
    {
        return $this->fetch();
    }

    public function get_insert_house_item()
    {
        $data = Tranlate::get_save(Request::instance()->post());
//        $data['check_in_time'] = strtotime($data['check_in_time']);
//        $data['leave_time'] = strtotime($data['leave_time']);
//        $title['content'] = $data['title'];
//        if($data['leave_time']=='')
//            $data['leave_time']=null;
//        $item = Title::where('content', $title['content'])->find();
//        if ($item == null) {
//            Title::create_item($title);
//            $item = Title::where('content', $title['content'])->find();
////            var_dump($item);
//        }
//        $data['title'] = $item['id'];
//        $location['name'] = $data['location'];
//        $item = Location::where('name', $location['name'])->find();
//        if ($item == null) {
//            Location::create_item($location);
//            $item = Location::where('name', $location['name'])->find();
//
//        }
//        $data['location'] = $item['id'];
//
//        $belong_to['name'] = $data['belong_to'];
//        $item = Belongto::where('name', $belong_to['name'])->find();
//        if ($item == null) {
//            Belongto::create_item($belong_to);
//            $item = Belongto::where('name', $belong_to['name'])->find();
//        }
//        $data['belong_to'] = $item['id'];

        $house = new House();
        foreach (Index::$lists as $index => $item) {
            $house[$item] = $data[$item];
        }

        if ($house->save()) {
            return $this->success("success", 'index/insert_house_item');
        }
//        var_dump($house);
//        var_dump(strtotime($house['check_in_time']));
//
    }

    public function search_item()
    {
        $data = array();
        foreach (Index::$lists as $index => $item) {
            $data[$item] = array();
            $query = Db::table('rh_house')->distinct(true)->field($item)->select();
//            return var_dump($query);
            foreach ($query as $i => $value) {
                array_push($data[$item], $value[$item]);
            }
        }
        $data = Tranlate::get_input($data);
//        return var_dump($data);
        $this->assign("data", $data);
        $this->assign("lists", Index::$lists);
        $this->assign("length", count(Index::$lists));
        return $this->fetch();
    }

    public function show_search_result()
    {
        $data = Request::instance()->post();
        $data=Tranlate::get_search_condition($data);
        $condition=[];
//        return var_dump($data);
        foreach ($data as $index => $item){
            if($item!="*"){
                $condition[$index]=$item;
            }
        }
        if(empty($condition)){
            $query=House::all();
        }
        else{
            var_dump($condition);
//            $query=House::where(['leave_time'=>$condition['leave_time']])->find();
            $query=House::where($condition)->select();
//            return var_dump($query);
        }

        foreach ($query as $index => $item){
            $query[$index]=Tranlate::get_show($item);
        }
        $this->assign('houses', $query);
        return $this->fetch();

    }

}
