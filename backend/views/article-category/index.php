<?php echo \yii\bootstrap\Html::a("添加",['article-category/add'],['class'=>'btn btn-success'])?>
<table class="table">
    <tr>
        <th>id</th>
        <th>分类名称</th>
        <th>状态</th>
        <th>排序</th>
        <th>简介</th>
        <th>分类中的相关分类</th>
        <th>操作</th>
    </tr>
    <?php foreach ($models as $model):?>
        <tr>
            <td><?=$model->id?></td>
            <td><?=$model->name?></td>
            <td><?=\backend\models\ArticleCategory::$statusarr[$model->status]?></td>
            <td><?=$model->sort?></td>
            <td><?=$model->intro?></td>
            <td><?=\backend\models\ArticleCategory::$ishelparr[$model->is_help]?></td>
            <td><?=\yii\bootstrap\Html::a("编辑",["article-category/edit" ,'id'=>$model->id],['class'=>'btn btn-info'])?>
                <?=\yii\bootstrap\Html::a("删除",["article-category/del",'id'=>$model->id],['class'=>'btn btn-info'])?></td>
        </tr>
    <?php endforeach;?>
</table>