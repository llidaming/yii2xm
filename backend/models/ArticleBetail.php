<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "article_detail".
 *
 * @property integer $article_id
 * @property string $comtent
 */
class ArticleBetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'comtent'], 'required'],
            [['comtent'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'comtent' => '文章内容',
        ];
    }
}
