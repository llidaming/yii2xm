<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "auth_item".
 *
 * @property string $name
 * @property integer $type
 * @property string $description
 * @property string $rule_name
 * @property resource $data
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property AuthAssignment[] $authAssignments
 * @property AuthRule $ruleName
 * @property AuthItemChild[] $authItemChildren
 * @property AuthItemChild[] $authItemChildren0
 * @property AuthItem[] $children
 * @property AuthItem[] $parents
 */
class AuthItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    //定义一个数据库中不存在的属性用来装所有权限
    public $permissions=[];
    public static function tableName()
    {
        return 'auth_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'],'unique'],
            [['type', 'created_at', 'updated_at'], 'integer'],
            [['description', 'data'], 'string'],
            [['name', 'rule_name'], 'string', 'max' => 64],
            [['permissions'],'safe'],
//            [['rule_name'], 'exist', 'skipOnError' => true, 'targetClass' => AuthRule::className(), 'targetAttribute' => ['rule_name' => 'name']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => '名称',
            'type' => 'Type',
            'description' => '简介',
            'rule_name' => 'Rule Name',
            'data' => 'Data',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
//    public function getAuthAssignments()
//    {
//        return $this->hasMany(AuthAssignment::className(), ['item_name' => 'name']);
//    }
//
//    /**
//     * @return \yii\db\ActiveQuery
//     */
//    public function getRuleName()
//    {
//        return $this->hasOne(AuthRule::className(), ['name' => 'rule_name']);
//    }
//
//    /**
//     * @return \yii\db\ActiveQuery
//     */
//    public function getAuthItemChildren()
//    {
//        return $this->hasMany(AuthItemChild::className(), ['parent' => 'name']);
//    }
//
//    /**
//     * @return \yii\db\ActiveQuery
//     */
//    public function getAuthItemChildren0()
//    {
//        return $this->hasMany(AuthItemChild::className(), ['child' => 'name']);
//    }
//
//    /**
//     * @return \yii\db\ActiveQuery
//     */
//    public function getChildren()
//    {
//        return $this->hasMany(AuthItem::className(), ['name' => 'child'])->viaTable('auth_item_child', ['parent' => 'name']);
//    }
//
//    /**
//     * @return \yii\db\ActiveQuery
//     */
//    public function getParents()
//    {
//        return $this->hasMany(AuthItem::className(), ['name' => 'parent'])->viaTable('auth_item_child', ['child' => 'name']);
//    }
}