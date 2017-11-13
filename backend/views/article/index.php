<?php echo \yii\bootstrap\Html::a("添加",['article/add'],['class'=>'btn btn-success'])?>
<table class="table">
    <tr>
        <th>id</th>
        <th>文章名</th>
        <th>状态</th>
        <th>排序</th>
        <th>录入时间</th>
        <th>文章分类</th>
        <th>简介</th>
        <th>操作</th>
    </tr>
    <?php foreach ($models as $model):?>
    <tr>
        <td><?=$model->id?></td>
        <td><?=$model->name?></td>
        <td><?=\backend\models\Article::$statusarr[$model->status]?></td>
        <td><?=$model->sort?></td>
        <td><?=date("Y-m-d H:i:s ",$model->inputtime)?></td>
        <td><?=$model->category->name?></td>
        <td><?=$model->intro?></td>

        <td><?=\yii\bootstrap\Html::a("编辑",["article/edit",'id'=>$model->id],['class'=>'btn  btn-primary'])?>
            <?=\yii\bootstrap\Html::a("查看",["article-betail/sel",'id'=>$model->id],['class'=>'btn btn-info'])?>
        <?=\yii\bootstrap\Html::a("删除",["article/del",'id'=>$model->id],['class'=>'btn btn-danger'])?>

        </td>
    </tr>
    <?php endforeach;?>
</table>
<?php
echo \yii\widgets\LinkPager::widget([
        'pagination' => $page
])

?>