<?php
/* @var $this yii\web\View */
?>
<h1>权限列表</h1>

<table class="table">
    <tr>
        <th>权限名称</th>
        <th>权限描述</th>
        <th>操作</th>
    </tr>
    <?php foreach ($permissions as $permission):?>

        <tr>
            <td>

                <?php
                echo strpos($permission->name,"/")?"---":"";
                ?><?=$permission->name?>
            </td>
            <td>

                <?=$permission->description?>
            </td>
            <td>
                <?php
                echo  \yii\bootstrap\Html::a("编辑",['edit','name'=>$permission->name]);
                echo  \yii\bootstrap\Html::a("删除",['del','name'=>$permission->name]);
                ?>
            </td>
        </tr>


    <?php endforeach;?>

</table>