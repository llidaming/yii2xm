<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2017/11/9
 * Time: 11:29
 */
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'adminname');
echo $form->field($model,'password')->passwordInput();
echo $form->field($model,'name')->checkboxList($roles);
echo $form->field($model,'email');
echo \yii\bootstrap\Html::submitButton("提交",['class'=>'btn btn-success']);

\yii\bootstrap\ActiveForm::end();
