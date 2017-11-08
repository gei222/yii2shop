<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/7
 * Time: 10:27
 */

namespace backend\models;
use yii\db\ActiveRecord;

class Gallery extends ActiveRecord
{


    public $imgFile;
    public function attributeLabels()
    {
        return [
            'imgFile' => 'logo',
        ];
    }
    public function rules()
    {
        return [
            [['imgFile'], 'required'],
            ['imgFile', 'file', 'extensions' => ['jpg', 'png', 'gif']],
        ];

    }
}