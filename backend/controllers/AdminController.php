<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2017/11/9
 * Time: 11:06
 */

namespace backend\controllers;


use backend\models\Admin;
use backend\models\AdminForm;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\widgets\LinkPager;

class AdminController extends Controller
{
    /**
     * @return string
     * 显示视图
     */

    public function actionIndex(){
        $pageSize=3;
        $count=Admin::find()->count();
        $page=new Pagination([
            'pageSize'=>$pageSize,
            'totalCount'=>$count,
        ]);
        $admin=Admin::find()->limit($page->limit)->offset($page->offset)->all();

//        显示视图

     return $this->render('index',['models'=>$admin,'page'=>$page]);
    }

    /**
     * @return string|\yii\web\Response
     * 用户添加代码
     */
    public function actionAdd(){
        $admin=new Admin();
        $request=\Yii::$app->request;
//        实列化RBAC组件
        $auth=\Yii::$app->authManager;
//        找到所有角色
          $roles=$auth->getRoles();
//          var_dump($role);exit;
//        把所有的角色对象转化为数组
          $roles=ArrayHelper::map($roles,"name",'name');
//          var_dump($role);exit;
        if($request->isPost){
//            var_dump($request->post());exit;
//            var_dump($admin->validate());exit;
          if($admin->load($request->post()) && $admin->validate()){
//              var_dump($request->post());exit;
//             加密
              $admin->password=\Yii::$app->security->generatePasswordHash($admin->password);
//              var_dump($admin->password);exit;
              $admin->add_time=time();
              $admin->token=\Yii::$app->security->generateRandomString();
              $admin->last_login_time=time();
              $admin->last_login_ip=\Yii::$app->request->userIP;
//              var_dump( $admin);exit;
              $admin->save();
              //找到admin角色
              if($admin->name) {
                  foreach ($admin->name as $v) {
                      $role = $auth->getRole($v);
                      //把当前用户对象追加到admin角中
                      $auth->assign($role, $admin->id);
                  }
              }
          }
         return $this->redirect(['index']);
        }
//        显示视图
        return $this->render('add',['model'=>$admin,'roles'=>$roles]);
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     * 用户编辑代码
     */
    public function actionEdit($id){
        $admin=Admin::findOne($id);
        $auth=\Yii::$app->authManager;
        $request=\Yii::$app->request;
        if($request->isPost){

//            var_dump($model);exit;
            if($admin->load($request->post())&&$admin->validate()){
//             加密
                $admins=Admin::findOne($id);
//                echo $id ;exit;
                if($admins->password!==$admin->password){

                    $admin->password=\Yii::$app->security->generatePasswordHash($admin->password);

             }
                $admin->last_login_ip=$_SERVER["REMOTE_ADDR"];

                $admin->save();


                if($admin->name) {
                    //   保存角色之前先删除原先的角色
                    $auth->revokeAll($admin->id);
//                    保存角色
                    foreach ($admin->name as $v) {
                        $role = $auth->getRole($v);
                        //把当前用户对象追加到admin角中
                        $auth->assign($role, $admin->id);
                    }
                }

            }

            return $this->redirect(['index']);

        }
        //        实列化RBAC组件

//        找到所有角色
        $roles=$auth->getRoles();
//          var_dump($roles);exit;
//        把所有的角色对象转化为数组
        $roles=ArrayHelper::map($roles,"name",'description');
//        var_dump($roles);exit;
//        找到当前用户所有角色
        $name=$auth->getRolesByUser($id);
//        var_dump($name);exit;
        $admin->name=array_keys($name);
//        显示视图
        return $this->render('add',['model'=>$admin,'roles'=>$roles]);
    }

      /**
       * @return string
       * 用户登录代码
       */
      public function actionLogin(){
//    实列化登录表单
          $form=new AdminForm();
        $request=\Yii::$app->request;
        if($request->isPost){
//            var_dump($request->post());exit;
        if($form->load($request->post())&&$form->validate()){
//            var_dump($form);exit;
            $admin=Admin::findOne(['adminname'=>$form->adminName]);
            if($admin){

//                (\Yii::$app->security->validatePassword($model->password,$admin->password_hash
                  if(\Yii::$app->security->validatePassword($form->password,$admin->password)){
//                      var_dump($request->post());exit;
//                      var_dump($admin);exit;
                      //执行登录last_login_ip
//                      var_dump($form->rememberMe);exit;
                      \Yii::$app->user->login($admin,$form->rememberMe?3600*24*7:0);
                      //跳转
                      $admin->last_login_ip=\Yii::$app->request->userIP;
                      $admin->last_login_time=time();
                      $admin->save();
                      return $this->redirect(['home']);
                  }else{
                      $form->addError('password',"密码错误");
                  }

            }else{
                $form->addError('adminName',"用户名不存在");
               }
        }
     }
//显示视图
          return $this->render('login',['model'=>$form]);
    }

    /**
     * @return \yii\web\Response
     * 处理用户登录的代码
     */
    public function actionLogout(){
    \Yii::$app->user->logout();
    return $this->redirect(['login']);
    }

    /**
     * @param $id
     * @return \yii\web\Response
     * 处理删除用户的代码
     */
    public function actionDel($id){
        //        实列化RBAC组件
        $auth=\Yii::$app->authManager;
        $admin=Admin::findOne($id);
        $auth->revokeAll($id);
        $admin->delete();
        return $this->redirect(['index']);
    }

//  后台首页
    public function actionHome(){
        return $this->render('home');
    }
}