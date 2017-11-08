<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/7
 * Time: 21:32
 */

namespace backend\models;
use yii\db\ActiveRecord;
class Count extends ActiveRecord
{
    public function attributeLabels()
    {
        return [

            'day' => '日期',
            'count'=>'商品数'
        ];
    }
    public function rules()
    {
        return [
            [['day','count'], 'required'],
        ];

    }
}