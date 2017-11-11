<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2017/11/11
 * Time: 11:45
 */

namespace backend\controllers;


use backend\models\AuthItem;
use yii\web\Controller;

class PermissionController extends Controller
{
   public function actionIndex(){
//      实列化RBAC组件
    $authManager=\Yii::$app->authManager;
//    显示所有权限把所有权限显示出来
       $permissions=$authManager->getPermissions();
       return $this->render('index',compact('permissions'));

   }

    /**
     * @return string|\yii\web\Response
     * 权限添加
     */
  public function actionAdd(){
//    new权限对象
     $model=new AuthItem();
     $request=\Yii::$app->request;
    if($request->isPost){

        if($model->load($request->post())&&$model->validate()){
//            shil化RBAC组件
            $authManager=\Yii::$app->authManager;
//            创建权限
            $permission=$authManager->createPermission($model->name);
//            添加描述
            $permission->description=$model->description;
            //添加权限 把权限添加到数据库
            $authManager->add($permission);
            \Yii::$app->session->setFlash("success","创建".$model->description."成功");
            return $this->refresh();
        }
    }

//显示图片
      return $this->render('add',['model'=> $model]);
  }

    /**
     * @param $name
     * @return string|\yii\web\Response
//     * 这里是处理权限编辑的代码
     */

    public function actionEdit($name){
//    new权限对象
        $model=AuthItem::findOne($name);
        $request=\Yii::$app->request;
        if($request->isPost){

            if($model->load($request->post())&&$model->validate()){
//            shil化RBAC组件
                $authManager=\Yii::$app->authManager;
//            创建权限
//                $permission=$authManager->createPermission($model->name);
//                找出当前权限对象
                $permission=$authManager->getPermission($model->name);
               if($permission){
                   //            添加描述
                   $permission->description=$model->description;
//              修改权限  把权限修改到数据库中
                   $authManager->update($model->name,$permission);
                   \Yii::$app->session->setFlash("success","创建".$model->description."成功");
                   return $this->redirect(["index"]);
               }else{
                   \Yii::$app->session->setFlash("danger","不能修改权限名称".$model->name);
                   return $this->refresh();
               }
            }
        }

//显示图片
        return $this->render('add',['model'=> $model]);
    }

    /**
     * @param $name
     * @return \yii\web\Response
     * 这里是处理权限删除的代码
     */
public function actionDel($name){
//            shil化RBAC组件
    $authManager=\Yii::$app->authManager;
//    找到要删除的权限
   $permission=$authManager->getPermission($name);
//   删除权限
   if($authManager->remove($permission)){
       \Yii::$app->session->setFlash("success","删除".$name."成功");
       return $this->redirect(['index']);
   }
}
}