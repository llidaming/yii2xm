<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2017/11/4
 * Time: 13:26
 */

namespace backend\controllers;


use backend\models\ArticleCategory;
use yii\web\Controller;

class ArticleCategoryController extends Controller
{
    /**
     * @return string
     * 这里是文章分类显示
     */
public function actionIndex(){
    $model=ArticleCategory::find()->orderBy(['sort'=>SORT_ASC])->where(['status'=>1])->all();

    return $this->render('index',['models'=>$model]);

}

    /**
     * @return string|\yii\web\Response
     * 文章分类添加
     */
public function actionAdd(){
    $model=new ArticleCategory();
    $model->status=1;
    $model->is_help=2;
   $request=\Yii::$app->request;
   if($model->load($request->post())){
       if($model->validate()){
           $model->save();
           \Yii::$app->session->setFlash("success","添加成功");
           return $this->redirect(['index']);

       }

   }
    return $this->render('add',['model'=>$model]);

}

    /**
     * @param $id
     * @return string|\yii\web\Response
     * 编辑的代码
     */

    public function actionEdit($id){
        $model=ArticleCategory::findOne($id);
        $model->status=1;
        $model->is_help=2;
        $request=\Yii::$app->request;
        if($model->load($request->post())){
            if($model->validate()){
                $model->save();
                \Yii::$app->session->setFlash("success","添加成功");
                return $this->redirect(['index']);

            }

        }
        return $this->render('add',['model'=>$model]);

    }

    public function actionDel($id){
        $model=ArticleCategory::findOne($id);
        if($model->status===1){
           $model->status=2;
           $model->save();
           \Yii::$app->session->setFlash("success","隐藏成功");
           return $this->redirect(['index']);
        }else{
            $model->status=1;
            $model->save();
            \Yii::$app->session->setFlash("success","还原成功");
            return $this->redirect(['index']);
        }
    }
}