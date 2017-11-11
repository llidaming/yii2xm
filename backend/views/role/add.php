<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2017/11/11
 * Time: 15:23
 */

$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($role,"name");
echo $form->field($role,"description")->textarea();
echo $form->field($role,'permissions')->checkboxList($permissions);
echo \yii\bootstrap\Html::submitButton("提交",['class'=>'btn btn-success']);
\yii\bootstrap\ActiveForm::end();