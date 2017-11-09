<?php
namespace backend\models;
use yii\base\Model;
class GoodsSearchForm extends Model
{
    public $keyWord;
    public $minPrice;
    public $maxPrice;
    public function rules()
    {
        return [
            [['minPrice','maxPrice'],'number'],
            ['keyWord','safe']
        ]; // TODO: Change the autogenerated stub
    }
}