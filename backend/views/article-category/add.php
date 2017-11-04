<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2017/11/4
 * Time: 13:47
 */
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'name');

echo $form->field($model,'sort');
echo $form->field($model,'intro');
echo $form->field($model,'status')->inline()->radioList(\backend\models\ArticleCategory::$statusarr);
echo $form->field($model,'is_help')->inline()->radioList(\backend\models\ArticleCategory::$ishelparr);
echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-success']);
\yii\bootstrap\ActiveForm::end();