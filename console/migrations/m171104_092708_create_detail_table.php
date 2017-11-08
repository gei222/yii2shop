<?php

use yii\db\Migration;

/**
 * Handles the creation of table `detail`.
 */
class m171104_092708_create_detail_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('detail', [
            'id' => $this->primaryKey(),
            'content'=>$this->text(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('detail');
    }
}
