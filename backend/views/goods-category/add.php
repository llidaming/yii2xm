<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2017/11/5
 * Time: 15:42
 */
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($model,"name");
echo $form->field($model,"parent_id")->hiddenInput();
echo  \liyuze\ztree\ZTree::widget([
    'setting' => '{
    callback:{
    onClick:function(event,treeId,treeNode){
    $("#goodscategory-parent_id").val(treeNode.id);
    }
    
    },
			data: {
				simpleData: {
					enable: true,
					idKey: "id",
					pIdKey: "parent_id" ,
					rootPId:0
				}
			}
		}',
    'nodes' => $cates
]);
echo $form->field($model,"intro")->textarea();
echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-success']);
\yii\bootstrap\ActiveForm::end();