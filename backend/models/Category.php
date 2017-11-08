<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/3 0003
 * Time: 14:11
 */
namespace backend\models;
use yii\db\ActiveRecord;
class Category extends ActiveRecord
{

    public function attributeLabels(){
        return [
            'name' => '名称',
            'intro' => '简介',
            'sort'=>'排序',
            'status' => '状态'
        ];

    }
    //制定规划
    public function rules(){
        return [
            [['name','intro','status'],'required'],
        ];
    }



}