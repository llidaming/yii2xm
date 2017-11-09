<?php

use yii\db\Migration;

/**
 * Handles the creation of table `admin`.
 */
class m171108_062122_create_admin_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('admin', [
            'id' => $this->primaryKey(),
            'adminname'=>$this->string(50)->notNull()->defaultValue("")->comment("用户名"),
            'password'=>$this->string(50)->notNull()->defaultValue("")->comment("用户户密码"),
            'salt'=>$this->string(6)->notNull()->defaultValue("")->comment("盐"),
            'email'=>$this->string(30)->notNull()->defaultValue("")->comment("邮箱"),
            'token'=>$this->string(32)->notNull()->defaultValue("")->comment("自动登录令牌"),
//            'token_create_time'=>$this->smallInteger(10)->comment("令牌创建时间"),
//            'add_time'=>$this->smallInteger(11)->notNull()->defaultValue("")->comment("注册时间"),
//            'last_login_time'=>$this->smallInteger()->comment("最后登录时间"),
            'last_login_ip'=>$this->string(15)->notNull()->defaultValue("")->comment("用户IP")
        ]);

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('admin');
    }
}
