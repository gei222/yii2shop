<?php

use yii\db\Migration;

/**
 * Handles the creation of table `brand`.
 */
class m171103_051819_create_brand_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('brand', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50),
            'intro'=>$this->text(),
            'logo'=>$this->string(255),
            'sort'=>$this->integer(20),
            'status'=>$this->integer(20),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('brand');
    }
}
