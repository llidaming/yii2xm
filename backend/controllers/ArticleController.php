<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2017/11/4
 * Time: 12:50
 */

namespace backend\controllers;


use backend\models\Article;
use backend\models\ArticleBetail;
use backend\models\ArticleCategory;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

class ArticleController extends Controller
{
    /**
     * @return string显示文章首页的
     */
    public function actionIndex()
    {
        $pageSize=3;
        $count=Article::find()->count();
//        创建分页对象
        $page=new Pagination([
            'pageSize'=>$pageSize,
            'totalCount'=>$count
        ]);
        $model = Article::find()->limit($page->limit)->offset($page->offset)->where(['status'=>1])->all();
        return $this->render('index', ['models' => $model,'page'=>$page]);
    }

    /**
     * @return string|\yii\web\Response
     * 文章添加
     */
    public function actionAdd()
    {

        $model = new Article();
        $model->status = 1;
        $articleBetail = new ArticleBetail();
        $category = ArticleCategory::find()->where(['status' => 1])->all();
        $arr = ArrayHelper::map($category, 'id', 'name');
        $request = \Yii::$app->request;
        if ($model->load($request->post())&&$model->validate()) {

            $model->inputtime = time();
            $model->save();
//            这下面是文章内容保存代码
            if ( $articleBetail->load($request->post()) &&  $articleBetail->validate()) {
                $articleBetail->article_id = $model->id;
                $articleBetail->save();
                \Yii::$app->session->setFlash("success", "文章添加成功");
                return $this->redirect(['index']);

            }
        }
            return $this->render('add', ['model' => $model, 'arr' => $arr, 'Betail' => $articleBetail]);


    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     * 这里是处理文章编辑的代码
     */

    public function actionEdit($id)
    {
        $model = Article::findOne($id);
        $articleBetail = ArticleBetail::findOne($id);
        $category = ArticleCategory::find()->where(['status' => 1])->all();
        $arr = ArrayHelper::map($category, 'id', 'name');
        $request = \Yii::$app->request;
        if ($model->load($request->post())&&$model->validate()) {

            $model->inputtime = time();
            $model->save();
//            这下面是文章内容保存代码
            if ( $articleBetail->load($request->post()) &&  $articleBetail->validate()) {
                $articleBetail->article_id = $model->id;
                $articleBetail->save();
                \Yii::$app->session->setFlash("success", "文章添加成功");
                return $this->redirect(['index']);

            }
        }
        return $this->render('add', ['model' => $model, 'arr' => $arr, 'Betail' =>$articleBetail]);


    }

    /**
     * @param $id
     * @return \yii\web\Response
     * 文章删除和还原
     */
    public function actionDel($id){

        $model=Article::findOne($id);
       if($model->status===1){
        $model->status=2;
        $model->save();
        \Yii::$app->session->setFlash("success", "文章删除成功");
           return $this->redirect(['index']);
       }else{
           $model->status=1;
           $model->save();
           \Yii::$app->session->setFlash("success", "文章还原成功");
           return $this->redirect(['index']);
       }
    }

}