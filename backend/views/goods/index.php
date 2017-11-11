<div class="row">
    <div class="col-md-2"><?=\yii\bootstrap\Html::a("添加",['add'],['class'=>'btn btn-info'])?></div>
    <div class="col-md-10">

        <!--  <form class="form-inline pull-right">
            <input type="text" class="form-control" id="minPrice" name="minPrice" size="8" placeholder="最低价" value="<?/*=Yii::$app->request->get('minPrice')*/?>"> -
            <input type="text" class="form-control" id="maxPrice" name="maxPrice"  size="8" placeholder="最高价" value="<?/*=Yii::$app->request->get('maxPrice')*/?>">
                <input type="text" class="form-control" id="keyword" name="keyword" placeholder="请输入商品名称或货号" value="<?/*=Yii::$app->request->get('keyword')*/?>">
            <button type="submit" class="btn btn-default">搜索</button>
        </form>-->


        <?php
//        $searchForm=new \backend\models\GoodsSearchForm();
        $form=\yii\bootstrap\ActiveForm::begin([
            'method' => 'get',
            'options' => ['class'=>"form-inline pull-right"]
        ]);
        echo $form->field($searchForm,'minPrice')->label(false)->textInput(['size'=>5,'placeholder'=>"最低价"]);
        echo "-";
        echo $form->field($searchForm,'maxPrice')->label(false)->textInput(['size'=>5,'placeholder'=>"最高价"]);
        echo " ";
        echo $form->field($searchForm,'keyWord')->label(false);
        echo " ";
        echo \yii\bootstrap\Html::submitButton("搜索",['class'=>'btn btn-success','style'=>"margin-bottom:8px"]);
        \yii\bootstrap\ActiveForm::end();
        ?>

    </div>


</div>

<table class="table">

    <tr>
        <th>id</th>
        <th>商品名称</th>
        <th>货号</th>
        <th>商品图片</th>
        <th>商品分类</th>
        <th>品牌</th>
        <th>市场价格</th>
        <th>本店价格</th>
        <th>库存</th>
        <th>是否上架</th>
        <th>状态</th>
        <th>排序</th>
        <th>录入时间</th>
        <th>操作</th>
    </tr>
<?php foreach ($models as $model ):?>
    <tr>
        <td><?=$model->id?></td>
        <td><?=$model->name?></td>
        <td><?=$model->sn?></td>
        <td><?=\yii\bootstrap\Html::img($model->logo,['height'=>50])?></td>
        <td><?=$model->category->name?></td>
        <td><?=$model->brand->name?></td>
        <td><?=$model->market_price?></td>
        <td><?=$model->shop_price?></td>
        <td><?=$model->stock?></td>
        <td><?=\backend\models\Goods::$sale[$model->is_on_sale]?></td>
        <td><?=\backend\models\Goods::$statusarr[$model->status]?></td>
        <td><?=$model->sort?></td>
        <td><?=date("Y-m-d H:i:s",$model->inputtime)?></td>
        <td><?=\yii\bootstrap\Html::a("编辑",['goods/edit','id'=>$model->id],['class'=>'btn btn-success'])?>
            <?=\yii\bootstrap\Html::a("详情",['goods/intro','id'=>$model->id],['class'=>'btn btn-info'])?>
           <?=\yii\bootstrap\Html::a("删除",['goods/del','id'=>$model->id],['class'=>'btn btn-danger'])?>

        </td>
    </tr>
<?php endforeach;?>


</table>
<?php
echo \yii\widgets\LinkPager::widget([
    'pagination' => $page
]);
?>