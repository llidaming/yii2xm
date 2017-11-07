<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2017/11/5
 * Time: 15:02
 */

namespace backend\components;


use creocoder\nestedsets\NestedSetsQueryBehavior;
use yii\db\ActiveQuery;

class MenuQuery extends ActiveQuery
{
    public function behaviors() {
        return [
            NestedSetsQueryBehavior::className(),

        ];
    }
}