<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/6
 * Time: 14:25
 */

namespace backend\models;
use yii\db\ActiveRecord;
class Goodss extends ActiveRecord
{
    public $imgFile;
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '商品名称',
            'sn' => '货号',
           'imgFile' => 'logo',
            'goods_category_id' => '商品分类id',
            'brand_id' => '品牌分类',
            'market_price' => '市场价格',
            'shop_price' => '商品价格',
            'stock' => '库存',
            'is_on_sale' => '是否在售(1在售 0下架)',
            'status' => '状态',
            'sort' => '排序',
           'create_time' => '添加时间',
            'view_times' => '浏览次数',
        ];
    }
    public function rules()
    {
        return [
            [['name','sn','is_on_sale', 'brand_id','imgFile','goods_category_id',], 'required'],
            [['market_price','shop_price','stock','view_times'],'integer'],
            ['imgFile','file','extensions'=>['jpg','png','gif']],
        ];
    }
}

