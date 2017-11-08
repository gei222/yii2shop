<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/7
 * Time: 14:42
 */

namespace backend\models;


use yii\db\ActiveRecord;

class Intro extends ActiveRecord
{
    public function attributeLabels()
    {
        return [
//            'article_id'=>'文章id',
            'content' => '内容',
        ];
    }
    public function rules()
    {
        return [
            [['content'], 'required'],
        ];

    }

}