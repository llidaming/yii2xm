<?=\yii\bootstrap\Html::a("添加分类",['goods-category/add'],['class'=>'btn btn-success'])?>
<?= \leandrogehlen\treegrid\TreeGrid::widget([
    'dataProvider' => $dataProvider,
    'keyColumnName' => 'id',
    'parentColumnName' => 'parent_id',
    'parentRootValue' => '0', //first parentId value
    'pluginOptions' => [
        'initialState' => 'collapsed',
    ],
    'columns' => [
        'name',
        'id',
        'parent_id',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update}{delete}'
        ]
    ]
]);
?>