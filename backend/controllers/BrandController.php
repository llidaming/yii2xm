<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2017/11/3
 * Time: 17:23
 */

namespace backend\controllers;


use backend\models\Brand;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\UploadedFile;

class BrandController extends Controller
{
    /**
     * @return string
     * 显示品牌首页的视图
     */
   public function actionIndex(){
//每页显示的条数
    $pageSize=3;
//总的条数
    $count=Brand::find()->count();
//       创建分页对象
       $page=new Pagination(
           [
            'pageSize'=>$pageSize,
          'totalCount'=>$count
           ]
       );
//       echo 111;exit;
       $model=Brand::find()->limit($page->limit)->offset($page->offset)->orderBy(['sort'=>SORT_ASC])->all();
       return $this->render('index',['models'=>$model,'page'=>$page]);


   }

    /**
     * @return string|\yii\web\Response
     * 这里是处理品牌添加的代码
     */

   public function actionAdd(){
       $model=new Brand();
//       $model->statusarr=['1'];
       $request=\Yii::$app->request;
       if($model->load($request->post())){
        $model->imgFile=UploadedFile::getInstance($model,'imgFile');
       if($model->validate()){
           $imgPath='images/'.time().rand(100,999).".".$model->imgFile->extension;
//         文件保存
          $model->imgFile->saveAs($imgPath,false);
          $model->logo=$imgPath;
       }
           $model->save();
       return $this->redirect(['index']);
           }
       return $this->render('add',['model'=>$model]);

   }

    /**这里是处理编辑的代码
     * @param $id
     * @return string|\yii\web\Response
     */
    public function actionEdit($id){
        $model=Brand::findOne($id);
//       $model->statusarr=['1'];
        $request=\Yii::$app->request;
        if($model->load($request->post())){
            $model->imgFile=UploadedFile::getInstance($model,'imgFile');
            if($model->validate()){
                $imgPath='@web/images/'.time().rand(100,999).".".$model->imgFile->extension;
//         文件保存
                $model->imgFile->saveAs($imgPath,false);
                $model->logo=$imgPath;
            }
            $model->save();
            return $this->redirect(['index']);
        }
        return $this->render('add',['model'=>$model]);

    }
   public function actionDel($id){
        $model=Brand::findOne($id);
        $model->delete();
        return $this->redirect(['index']);
   }


}