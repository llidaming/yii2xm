<?php

namespace backend\controllers;

use backend\models\GoodsCategory;
use yii\data\ActiveDataProvider;
use yii\db\Exception;
use yii\helpers\Json;

/**
 * Class GoodsCategoryController
 * @package backend\controllers
 *
 */
class GoodsCategoryController extends \yii\web\Controller
{
    /**
     * @return string
     * 显示所有分类
     */
    public function actionIndex()
    {

        $query = GoodsCategory::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false
        ]);
        return  $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionIndex1(){
        $cate=GoodsCategory::find()->all();

        return $this->render('index1', ['cates' => $cate]);
    }
    /**
     * 创建分类根目录
     *
     */

    public function actionAdd(){
    $model=new GoodsCategory();
      $request=\Yii::$app->request;
      if($model->load($request->post())){

//          判断是否是创建根目录
          if($model->parent_id==0){
//              创建根目录分类
                  $model->makeRoot();

          }else{
//           创建子类分类
              $cateParent=GoodsCategory::findOne(['id'=>$model->parent_id]);
              $model->prependTo($cateParent);
          }
          \Yii::$app->session->setFlash("success","创建分类成功");
          return $this->redirect(['index']);
      }
//  得到所有分类
      $cates=GoodsCategory::find()->asArray()->all();
      $cates[]=['id'=>0,'parent_id'=>0,'name'=>'顶级分类'];
      $cates=Json::encode($cates);
//    var_dump($cate->getErrors());exit;
        return $this->render('add',['model'=>$model,'cates'=>$cates]);

    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     * 这里是处理修改的代码
     */

    public function actionEdit($id){
        $model=GoodsCategory::findOne($id);
        $request=\Yii::$app->request;
        if($model->load($request->post())){
//            $goods=GoodsCategory::find()->where()->
//            if
            try{
                //          判断是否是创建根目录
                if($model->parent_id==0){
//              创建根目录分类
                    $model->makeRoot();

                }else{
//           创建子类分类
                    $cateParent=GoodsCategory::findOne(['id'=>$model->parent_id]);
                    $model->prependTo($cateParent);
                }
//        $e 这个变量必须是这个异常类Exception的对象通过异常捕获得到不能修改到子类的才跳转
            }catch (Exception $e){
        \Yii::$app->session->setFlash("danger",$e->getMessage());
         return $this->refresh();
            }


            \Yii::$app->session->setFlash("success","创建分类成功");
            return $this->redirect(['index']);
        }
//  得到所有分类
        $cates=GoodsCategory::find()->asArray()->all();
        $cates[]=['id'=>0,'parent_id'=>0,'name'=>'顶级分类'];
        $cates=Json::encode($cates);
//    var_dump($cate->getErrors());exit;
        return $this->render('add',['model'=>$model,'cates'=>$cates]);

    }

    public function actionDel($id){
        $model=GoodsCategory::findOne($id);
        $v=GoodsCategory::find()->where(['parent_id'=>$id])->all();
//       var_dump($v);exit;
        if($v){
            \Yii::$app->session->setFlash("success","有子分类不能删除");
        }else{
//            删除节点和根节点
            $model->deleteWithChildren();
//            这个不能删除根节点
//            $model->delete();
            \Yii::$app->session->setFlash('success',"删除分类成功");
        }
        return $this->redirect(['index']);
    }

}
