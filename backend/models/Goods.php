<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "goods".
 *
 * @property integer $id
 * @property string $name
 * @property string $sn
 * @property string $logo
 * @property integer $goods_category_id
 * @property integer $brand_id
 * @property integer $market_price
 * @property integer $shop_price
 * @property integer $stock
 * @property integer $is_on_sale
 * @property integer $status
 * @property integer $sort
 * @property integer $inputtime
 */
class Goods extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
//    public $imgFlie;
    public static $statusarr=['1'=>'显示','0'=>'隐藏'];
    public static $sale=['1'=>'上架','2'=>'下架'];
    public static function tableName()
    {
        return 'goods';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name',  'logo', 'goods_category_id', 'brand_id', 'market_price', 'shop_price', 'stock', 'is_on_sale', 'status', 'sort'], 'required'],
            [['goods_category_id', 'brand_id', 'market_price', 'shop_price', 'stock', 'is_on_sale', 'status', 'sort'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [[ 'logo'], 'string', 'max' => 255],
//            [['imgFlie'],'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '商品名',
            'sn' => '货号',
            'logo' => '商品图片',
            'goods_category_id' => '商品分类id',
            'brand_id' => '品牌id',
            'market_price' => '市场价格',
            'shop_price' => '本店价格',
            'stock' => '库存',
            'is_on_sale' => '是否上架',
            'status' => '状态',
            'sort' => '排序',
            'inputtime' => '录入时间',
        ];
    }
//品牌一对一
    public function getBrand(){
        return $this->hasOne(Brand::className(),['id'=>'brand_id']);
    }
//    分类一对一
    public function getCategory(){
        return $this->hasOne(GoodsCategory::className(),['id'=>'goods_category_id']);
    }
//商品详情的一对一
    public function getIntro(){
        return $this->hasOne(GoodsIntro::className(),['goods_id'=>'id']);
    }
}
