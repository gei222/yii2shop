<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/3 0003
 * Time: 16:59
 */

namespace backend\models;
use yii\db\ActiveRecord;
class Article extends ActiveRecord
{
    public function attributeLabels()
    {
        return [
            'name' => '名字',
            'intro' => '简介',
           'article_category_id' => '文章分类id',
            'sort' => '排序',
            'status' => '状态',
            'create_time' => '创建时间'
        ];
    }
    public function rules()
    {
        return [
            [['name', 'intro', 'status','article_category_id'], 'required'],
//            ['create_time','integer'],
        ];

    }




}