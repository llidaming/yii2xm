<?php

use yii\db\Migration;

/**
 * Handles the creation of table `goods_category`.
 */
class m171105_063415_create_goods_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('goods_category', [
            'id' => $this->primaryKey()->comment('id'),
           'tree' => $this->integer()->notNull()->comment("树"),
            'lft' => $this->integer()->notNull()->comment("左值"),
            'rgt' => $this->integer()->notNull()->comment("右值"),
            'depth' => $this->integer()->notNull()->comment("深度"),
            'name' => $this->string()->notNull()->comment("分类类名称"),
            'intro'=>$this->string()->notNull()->comment("简介"),
            'parent_id'=>$this->integer()->notNull()->defaultValue(0)->comment("分类父id"),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('goods_category');
    }
}
