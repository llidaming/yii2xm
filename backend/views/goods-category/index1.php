<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2017/11/9
 * Time: 17:25
 */
?>
<?=\yii\bootstrap\Html::a("添加",['goods-category/add'],['class'=>'btn btn-success'])?>
<table class="table">
    <tr>
        <th>Id</th>
        <th>名称</th>
        <th>简介</th>
        <th></th>
    </tr>
    <?php foreach ($cates as $cate):?>

        <tr>
            <td><?=$cate->id ?></td>
            <td><?=$cate->nameText ?></td>
            <td><?=$cate->intro ?></td>
            <td>
             <?=\yii\bootstrap\Html::a("编辑",['goods-category/edit','id'=>$cate->id],['class'=>'btn btn-success'])?>
             <?=\yii\bootstrap\Html::a("删除",['goods-category/del','id'=>$cate->id],['class'=>'btn btn-danger'])?>

            </td>
        </tr>

    <?php endforeach;?>


</table>
