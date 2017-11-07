

<?php  echo   \yii\bootstrap\Html::a('添加品牌',['brand/add'],['class'=>'btn btn-success'])?>
<?php  echo   \yii\bootstrap\Html::a('回收站',['brand/hide'],['class'=>'btn btn-warning'])?>
<table class="table">
    <tr>
        <th>id</th>
        <th>品牌名称</th>
        <th>图片</th>
        <th>排序</th>
        <th>状态</th>
        <th>操作</th>
    </tr>
    <?php foreach ($models as $model):?>
   <tr><td><?=$model->id?></td>
    <td><?=$model->name?></td>
    <td><?=\yii\bootstrap\Html::img($model->image,['height'=>50])?></td>
    <td><?=$model->sort?></td>
    <td><?=\backend\models\Brand::$statusarr[$model->status]?></td>
    <td><?php echo \yii\bootstrap\Html::a("编辑",['brand/edit','id'=>$model->id],['class'=>'btn btn-success'])?>
         <?php echo \yii\bootstrap\Html::a("删除   ",['brand/del','id'=>$model->id],['class'=>'btn btn-warning'])?>

        </td></tr>



<?php  endforeach;?>

    </table>
<?php

echo \yii\widgets\LinkPager::widget(
        [
                'pagination' => $page,
        ]
)
?>