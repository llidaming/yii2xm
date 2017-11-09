<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "admin".
 *
 * @property integer $id
 * @property string $adminname
 * @property string $password
 * @property string $salt
 * @property string $email
 * @property string $token
 * @property string $last_login_ip
 * @property integer $token_create_time
 * @property integer $add_time
 * @property integer $last_login_time
 */
class Admin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['token_create_time', 'last_login_time'], 'required'],
//            [['token_create_time', 'add_time', 'last_login_time'], 'integer'],
            [['adminname', 'password'], 'string', 'max' => 50],
//            [['salt'], 'string', 'max' => 6],
            [['email'], 'string', 'max' => 30],
            [['token'], 'string', 'max' => 32],
            [['last_login_ip'], 'string', 'max' => 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'adminname' => '用户名',
            'password' => '用户户密码',
//            'salt' => '盐',
            'email' => '邮箱',
            'token' => '自动登录令牌',
            'last_login_ip' => '用户IP',
//            'token_create_time' => '令牌创建时间',
//            'add_time' => '注册时间',
//            'last_login_time' => '最后登录时间',
        ];
    }
}
