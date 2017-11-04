<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2017/11/4
 * Time: 17:58
 */

namespace backend\controllers;


use backend\models\ArticleBetail;
use yii\web\Controller;

class ArticleBetailController extends Controller
{
    public function actionSel($id){
//  echo $id;exit;
        $model=ArticleBetail::findOne($id);
        return $this->render('sel',['model'=>$model ,'id'=>$id]);
    }
}