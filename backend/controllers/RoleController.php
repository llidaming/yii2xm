<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2017/11/11
 * Time: 14:38
 */

namespace backend\controllers;


use backend\models\AuthItem;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

class RoleController extends Controller
{
    /**
     * @return string
     * 角色显示的代码
     */
   public function actionIndex(){
//  实列化RBAC组件对象
       $authManager=\Yii::$app->authManager;
//       显示所有角色把角色显示出来
       $roles=$authManager->getRoles();
//       显示视图
       return $this->render('index',compact("roles"));
   }

    /**
     * @return string|\yii\web\Response
     * 这是角色创建的代码
     */
   public function actionAdd(){
       //  实列化RBAC组件对象

       $authManager=\Yii::$app->authManager;
//实列角色对象
       $role=new AuthItem();
     $request=\Yii::$app->request;
     if($request->isPost){
         if($role->load($request->post())&&$role->validate()){

//             创建角色
             $model=$authManager->createRole($role->name);
//             添加描述
             $model->description=$role->description;
//             添加角色把角色添加到数据库中
             if($authManager->add($model)){
//                 给角色添加权限
                 if($role->permissions){
                     foreach ($role->permissions as $permission){
//                         分别把权限名称添加到对应的角色中
                         $authManager->addChild($model,$authManager->getPermission($permission));
                     }
                 }
             }
         }
         \Yii::$app->session->setFlash("success","创建".$role->description."成功");
         return $this->redirect(['index']);
     }
//       得到所有权限
       $permissions=$authManager->getPermissions();
//       把对象转化为数组

       $permissions=ArrayHelper::map($permissions,"name","description");
//       显示视图
       return $this->render('add',compact('role','permissions'));
   }

    /**
     * @param $name
     * @return string|\yii\web\Response
     * c处理修改权限的代码
     */


    public function actionEdit($name){
        //  实列化RBAC组件对象
//        var_dump($name);exit;
       $authManager=\Yii::$app->authManager;
      //实列角色对象
        $role=AuthItem::findOne($name);
//        通过角色得到所有角色的权限
        $rolePermission=$authManager->getPermissionsByRole($name);
//        var_dump(array_keys($rolePermission));exit;
        $role->permissions=array_keys($rolePermission);
        $request=\Yii::$app->request;
        if($request->isPost){
            if($role->load($request->post())&&$role->validate()){
//             找出当前角色
                $model=$authManager->getRole($role->name);
                if($model){
                    //             添加描述
                    $model->description=$role->description;
                    //             修改角色把角色修改到数据库中
                    if($authManager->update($role->name,$model)){

                        //在修改权限之前删除当前角色所有的权限
                        $authManager->removeChildren($model);
//                 给角色添加权限
                        if($role->permissions){
                            foreach ($role->permissions as $permission){
//                         分别把权限名称添加到对应的角色中
                                $authManager->addChild($model,$authManager->getPermission($permission));
                            }
                        }
                    }

                    \Yii::$app->session->setFlash("success","创建".$role->description."成功");
                    return $this->redirect(['index']);

                }else{

                    \Yii::$app->session->setFlash("danger","不能修改角色名称".$role->name);
                    return $this->refresh();

                }


            }

        }
//       得到所有权限
        $permissions=$authManager->getPermissions();
//       把对象转化为数组

        $permissions=ArrayHelper::map($permissions,"name","description");
//       显示视图
        return $this->render('add',compact('role','permissions'));
    }

    /**
     * @param $name
     * 这里是处理删除角色的代码
     */
public function actionDel($name){
//        实列化RBAC组件
    $authManager=\Yii::$app->authManager;
//    找到要删除的角色对象
    $role=$authManager->getRole($name);
//    删除当前角色所有权限
     $authManager->removeChildren($role);
//     删除角色
    if($authManager->remove($role)){
        \Yii::$app->session->setFlash("success","删除".$name."成功");
        return $this->redirect(["index"]);
    }
}

}