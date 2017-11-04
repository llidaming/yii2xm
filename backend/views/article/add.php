<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2017/11/4
 * Time: 14:35
 */
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'name');
echo $form->field($model,'category_id')->dropDownList($arr);
echo $form->field($model,'status')->inline()->radioList(\backend\models\Article::$statusarr);
echo $form->field($model,'sort');
echo $form->field($model,'intro')->textarea();
echo $form->field($Betail,'comtent')->textarea();
echo \yii\bootstrap\Html::submitButton("提交",['class'=>'btn btn-success']);
\yii\bootstrap\ActiveForm::end();