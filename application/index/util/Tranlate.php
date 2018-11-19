<?php
/**
 * Created by PhpStorm.
 * User: 资霄
 * Date: 2018/9/25
 * Time: 10:16
 */

namespace app\index\util;

use app\index\model\Belongto;
use app\index\model\Location;
use app\index\model\Title;

class Tranlate
{
    public static function get_input($data)
    {
        foreach ($data['title'] as $index => $item) {
            if ($item != null) {
                $query = Title::where('id', $item)->find();
                $data['title'][$index] = $query['content'];
            }
        }
        foreach ($data['location'] as $index => $item) {
            if ($item != null) {
                $query = Location::where('id', $item)->find();
                $data['location'][$index] = $query['name'];
            }
        }
        foreach ($data['belong_to'] as $index => $item) {
            if ($item != null) {
                $query = Belongto::where('id', $item)->find();
                $data['belong_to'][$index] = $query['name'];
            }
        }
        return $data;
    }

    public static function get_show($data)
    {
        if ($data['title'] != null) {
            $query = Title::where('id', $data['title'])->find();
            $data['title'] = $query['content'];
        }

        if ($data['location'] != null) {
            $query = Location::where('id', $data['location'])->find();
            $data['location'] = $query['name'];
        }

        if ($data['belong_to'] != null) {
            $query = Belongto::where('id', $data['belong_to'])->find();
            $data['belong_to'] = $query['name'];
        }
        return $data;
    }

    public static function get_search_condition($data)
    {
        foreach ($data as $index => $item) {
            if ($data[$index] == '')
                $data[$index] = null;
        }
        if ($data['title'] != "*" && $data['title'] != null) {
            $title['content'] = $data['title'];
            $item = Title::where('content', $title['content'])->find();
            if ($item == null) {
                $data['title'] = null;
//            var_dump($item);
            } else {
                $data['title'] = $item['id'];
            }
        }
        if ($data['location'] != "*" && $data['location'] != null) {
            $location['name'] = $data['location'];
            $item = Location::where('name', $location['name'])->find();
            if ($item == null) {
                $data['title'] = null;
//            var_dump($item);
            } else {
                $data['title'] = $item['id'];
            }
        }
        if ($data['belong_to'] != "*" && $data['belong_to'] != null) {
            $belong_to['name'] = $data['belong_to'];
            $item = Belongto::where('name', $belong_to['name'])->find();
            if ($item == null) {
                $data['title'] = null;
//            var_dump($item);
            } else {
                $data['title'] = $item['id'];
            }
        }
        return $data;
    }

    public static function get_save($data)
    {
        foreach ($data as $index => $item) {
            if ($data[$index] == '')
                $data[$index] = null;
        }
        $title['content'] = $data['title'];
        if ($title['content'] != null) {
            $item = Title::where('content', $title['content'])->find();
            if ($item == null) {
                Title::create_item($title);
                $item = Title::where('content', $title['content'])->find();
//            var_dump($item);
            }
            $data['title'] = $item['id'];
        }
        $location['name'] = $data['location'];
        if ($location['name'] != null) {
            $item = Location::where('name', $location['name'])->find();
            if ($item == null) {
                Location::create_item($location);
                $item = Location::where('name', $location['name'])->find();

            }
            $data['location'] = $item['id'];
        }
        $belong_to['name'] = $data['belong_to'];
        if ($belong_to['name'] != null) {
            $item = Belongto::where('name', $belong_to['name'])->find();
            if ($item == null) {
                Belongto::create_item($belong_to);
                $item = Belongto::where('name', $belong_to['name'])->find();
            }
            $data['belong_to'] = $item['id'];
        }
        return $data;
    }
}