


<?=\yii\bootstrap\Html::a("添加",['admin/add'],['class'=>'btn btn-success'])?>

<table class="table">
    <tr>
        <th>id</th>
        <th>管理员名</th>
        <th>邮箱</th>
        <th>注册时间</th>
        <th>登录时间</th>
        <th>用户登录iP</th>
        <th>操作</th>
    </tr>
<?php foreach ($models as $model):?>
    <tr>
        <td><?=$model->id?></td>
        <td><?=$model->adminname?></td>
        <td><?=$model->email?></td>
        <td><?=date("Y-m-d H:i:s",$model->add_time)?></td>
        <td><?=date("Y-m-d H:i:s",$model->last_login_time)?></td>
        <td><?=$model->last_login_ip?></td>
        <td>
            <?=\yii\bootstrap\Html::a("编辑",['admin/edit','id'=>$model->id],['class'=>'btn btn-info'])?>
            <?=\yii\bootstrap\Html::a("删除",['admin/del','id'=>$model->id],['class'=>'btn btn-danger'])?>

        </td>
    </tr>
<?php endforeach;?>

</table>
<?php
echo \yii\widgets\LinkPager::widget([
    'pagination' => $page,
])

?>