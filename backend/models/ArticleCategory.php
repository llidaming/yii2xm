<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "article_category".
 *
 * @property integer $id
 * @property string $name
 * @property string $intro
 * @property integer $status
 * @property integer $sort
 * @property integer $is_help
 */
class ArticleCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static $statusarr=['1'=>'显示','2'=>'隐藏'];
    public static $ishelparr=['1'=>'客户帮助','2'=>'基本分类'];
    public static function tableName()
    {
        return 'article_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'intro', 'status', 'sort', 'is_help'], 'required'],
            [['status', 'sort', 'is_help'], 'integer'],
            [['name'], 'string', 'max' => 30],
            [['intro'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '分类名称',
            'intro' => '简介',
            'status' => '状态',
            'sort' => '排序',
            'is_help' => '是否是帮助相关的分类',
        ];
    }
}
