<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2017/11/3
 * Time: 17:13
 */

namespace backend\models;


use yii\db\ActiveRecord;

class Brand extends ActiveRecord
{
    public $imgFile;
    public static $statusarr=['1'=>'显示','0'=>'隐藏','-1'=>'删除'];
    public function rules()
    {
        return [
            [['name','sort','status'],'required'],
            [['sort','status'],'integer'],
            [['imgFile'],'file','extensions' => ['jpg','opg','png'],'skipOnEmpty' => [true] ]
        ]; // TODO: Change the autogenerated stub
    }
    public function attributeLabels()
    {
        return [
            'name'=>'品牌名称',
            'sort'=>'排序',
            'imgFile'=>'图片',
            'status'=>'状态'
        ]; // TODO: Change the autogenerated stub
    }
}