<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article`.
 */
class m171104_030404_create_article_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('article', [
            'id' => $this->primaryKey(),
            'name'=>$this->string("30")->notNull()->defaultValue("")->comment('文章名称'),
            'intro'=>$this->string("100")->notNull()->defaultValue("")->comment('简介'),
            'article_category_id'=>$this->smallInteger(3)->notNull()->defaultValue("")->comment('文章分类ID'),
            'status'=>$this->smallInteger(1)->notNull()->defaultValue("")->comment("状态"),
            'sort'=>$this->smallInteger(10)->notNull()->defaultValue("")->comment("排序"),
            'inputtime'=>$this->smallInteger(10)->notNull()->defaultValue("")->comment("录入时间"),
        ]);
    }


    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('article');
    }
}
