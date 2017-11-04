<?php
echo \yii\bootstrap\Html::a('首页',['article/index']);

$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'comtent')->textarea();
echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-success']);
echo \yii\bootstrap\Html::a("删除",["article/del",'id'=>$id],['class'=>'btn btn-info']);
\yii\bootstrap\ActiveForm::end();
?>
