<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2017/11/11
 * Time: 14:52
 */

?>
<h1>权限列表</h1>

<table class="table">
    <tr>
        <th>角色名称</th>
        <th>角色描述</th>
        <th>角色权限</th>
        <th>操作</th>
    </tr>
    <?php foreach ($roles as $role):?>
        <tr>
            <td><?=$role->name?></td>
            <td><?=$role->description?></td>
            <td>
                <?php
                $authManager=\Yii::$app->authManager;
//                找到当前角色的权限
                $permissions=$authManager->getPermissionsByRole($role->name);
                foreach ($permissions as $permission){
                    echo $permission->description."||";
                }
                ?>
            </td>
            <td>
                <?php
                echo  \yii\bootstrap\Html::a("编辑",['edit','name'=>$role->name]);
                echo  \yii\bootstrap\Html::a("删除",['del','name'=>$role->name]);
                ?>
            </td>
        </tr>


    <?php endforeach;?>

</table>