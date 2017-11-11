<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2017/11/11
 * Time: 13:26
 */

$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($model,"name");
echo $form->field($model,"description")->textarea();
echo \yii\bootstrap\Html::submitButton("提交",['class'=>'btn btn-success']);
\yii\bootstrap\ActiveForm::end();