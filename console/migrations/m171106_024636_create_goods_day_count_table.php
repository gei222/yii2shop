<?php

use yii\db\Migration;

/**
 * Handles the creation of table `goods_day_count`.
 */
class m171106_024636_create_goods_day_count_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('goods_day_count', [
            'id' => $this->primaryKey(),
            'day'=>$this->date(),
            'count'=>$this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('goods_day_count');
    }
}
