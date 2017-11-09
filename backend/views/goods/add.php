<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2017/11/7
 * Time: 13:30
 */
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($model,"name");
//echo $form->field($model,"sn");
echo $form->field($model,"logo")->widget('manks\FileInput', []);
echo $form->field($gallery,'imgFile')->widget('manks\FileInput', [
    'clientOptions' => [
        'pick' => [
            'multiple' => true,
        ],
        'server' =>\yii\helpers\Url::to(['uploads']),
        'accept' => [
            'extensions' => 'gif,jpg,jpeg,bmp,png',
         ],
    ],
]);
echo $form->field($model,'stock');
echo $form->field($model,"goods_category_id")->dropDownList($category);
echo $form->field($model,"brand_id")->dropDownList($brand);
echo $form->field($model,"market_price");
echo $form->field($model,"shop_price");
echo $form->field($model,"is_on_sale")->inline()->radioList(\backend\models\Goods::$sale);
echo $form->field($model,"status")->inline()->radioList(\backend\models\Goods::$statusarr);
echo $form->field($model,"sort");
echo $form->field($intro,'content')->widget('kucha\ueditor\UEditor',[]);
echo \yii\bootstrap\Html::submitButton("提交",['class'=>'btn btn-success']);
\yii\bootstrap\ActiveForm::end();
