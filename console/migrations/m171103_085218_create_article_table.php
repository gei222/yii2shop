<?php

use yii\db\Migration;

/**
 * Handles the creation of table `category`.
 */
class m171103_085218_create_article_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('category', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50),
            'intro'=>$this->text(),
            'article_category_id'=>$this->integer(),
            'sort'=>$this->integer(20),
            'status'=>$this->integer(20),
            'create_time'=>$this->integer(),

        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('category');
    }
}
