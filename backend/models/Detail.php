<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/3 0003
 * Time: 16:59
 */

namespace backend\models;
use yii\db\ActiveRecord;
class Detail extends ActiveRecord
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