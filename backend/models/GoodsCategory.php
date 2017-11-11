<?php

namespace backend\models;

use backend\components\MenuQuery;
use creocoder\nestedsets\NestedSetsBehavior;
use Yii;

/**
 * This is the model class for table "goods_category".
 *
 * @property integer $id
 * @property integer $tree
 * @property integer $lft
 * @property integer $rgt
 * @property integer $depth
 * @property string $name
 * @property string $intro
 * @property integer $parent_id
 */
class GoodsCategory extends \yii\db\ActiveRecord
{
    /**
     * @return array
     * 无限极分类的模型是一个行为
     */
    public function behaviors() {
        return [
            'tree' => [
                'class' => NestedSetsBehavior::className(),
                'treeAttribute' => 'tree',
                // 'leftAttribute' => 'lft',
                // 'rightAttribute' => 'rgt',
                // 'depthAttribute' => 'depth',
            ],
        ];
    }

    /**
     * @return array
     */
    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    /**
     * @return MenuQuery
     */
    public static function find()
    {
        return new MenuQuery(get_called_class());

    }

    /**
     * @inheritdoc
     */

    public static function tableName()
    {
        return 'goods_category';
    }


    /**
     * @inheritdoc
     */

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'name'], 'required'],
            [['tree', 'lft', 'rgt', 'depth', 'parent_id'], 'integer'],
            [['name', 'intro'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'tree' => '树',
            'lft' => '左值',
            'rgt' => '右值',
            'depth' => '深度',
            'name' => '分类类名称',
            'intro' => '简介',
            'parent_id' => '分类父id',
        ];
    }

//根据深度给分类加“-”
    public function getNameText(){
        return str_repeat("-",4*$this->depth).$this->name;
    }

}
