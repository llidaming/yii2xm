<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "article".
 *
 * @property integer $id
 * @property string $name
 * @property string $intro
 * @property integer $status
 * @property integer $sort
 * @property integer $inputtime
 * @property integer $category_id
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static $statusarr=['1'=>'显示','2'=>'隐藏'];
    public static function tableName()
    {
        return 'article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'intro', 'status', 'sort',  'category_id'], 'required'],
            [['status', 'sort', 'category_id'], 'integer'],
            [['name'], 'string', 'max' => 30],
            [['intro'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '名称',
            'intro' => '简介',
            'status' => '状态',
            'sort' => '排序',
//            'inputtime' => '录入时间',

            'category_id' => 'Category ID',
        ];
    }
    public function getCategory(){
       return $this->hasOne(ArticleCategory::className(),['id'=>'category_id']);
    }
}
