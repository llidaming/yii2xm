

<?php  echo   \yii\bootstrap\Html::a('首页',['brand/index'],['class'=>'btn btn-primar'])?>
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
    <td><?=\yii\bootstrap\Html::img("@web/".$model->logo,['height'=>50])?></td>
    <td><?=$model->sort?></td>
    <td><?=\backend\models\Brand::$statusarr[$model->status]?></td>
    <td><?php echo \yii\bootstrap\Html::a("还原",['brand/hy','id'=>$model->id],['class'=>'btn btn-success'])?>
         <?php echo \yii\bootstrap\Html::a("彻底删除   ",['brand/del','id'=>$model->id],['class'=>'btn btn-danger'])?>

        </td></tr>



<?php  endforeach;?>

    </table>
<?php
echo \yii\widgets\LinkPager::widget(
        [
                'pagination' => $page
        ]
)
?>