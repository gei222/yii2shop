<?php

use yii\db\Migration;

/**
 * Handles the creation of table `goods`.
 */
class m171106_060624_create_goods_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('goods', [
            'id' => $this->primaryKey(),
            'name'=>$this->string()->notNull(),
            'sn'=>$this->integer()->notNull(),
            'logo'=>$this->string()->notNull(),
            'goods_category_id'=>$this->integer()->notNull(),
            'brand_id'=>$this->integer()->notNull()->comment('品牌id'),
            'market_price'=>$this->decimal()->notNull()->comment('市场价格'),
            'shop_price'=>$this->decimal()->notNull()->comment('商品价格'),
            'stock'=>$this->integer()->notNull(),
            'is_on_sale'=>$this->string()->notNull(),
            'status'=>$this->string()->notNull(),
            'sort'=>$this->string()->notNull(),
            'create_time'=>$this->integer()->notNull(),
            'view_times'=>$this->integer()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('goods');
    }
}
