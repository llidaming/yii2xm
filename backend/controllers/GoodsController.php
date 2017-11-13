<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2017/11/7
 * Time: 11:50
 */

namespace backend\controllers;


use backend\models\Brand;
use backend\models\Goods;
use backend\models\GoodsCategory;
use backend\models\GoodsDayCount;
use backend\models\GoodsGallery;
use backend\models\GoodsIntro;
use backend\models\GoodsSearchForm;
use Couchbase\GeoDistanceSearchQuery;
use flyok666\qiniu\Qiniu;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Controller;

class GoodsController extends Controller
{

    public function actions()
    {
        return [
            'upload' => [
                'class' => 'kucha\ueditor\UEditorAction',
            ]
        ];
    }

    public function actionIndex(){
//        构造查询对象
        $query=Goods::find();
        $request=\Yii::$app->request;
//        var_dump($request->get());exit;
        $requests=$request->get('GoodsSearchForm');
//        不能这样写会报错
//        $requests=$request->get()['GoodsSearchForm'];
//        接收变量
         $keyWord=$requests['keyWord'];
//        var_dump($keyWord);exit;
         $minPrice=$requests['minPrice'];
         $maxPrice=$requests['maxPrice'];
//        $status=$requests['status'];
        if($minPrice>0){
////            拼接条件
            $query->andWhere("shop_price>={$minPrice}");
        }
        if($maxPrice>0){
            $query->andWhere("shop_price<={$maxPrice}");
        }
        if(isset($keyWord)){
            $query->andWhere("name like '%{$keyWord}%' or sn like '%{$keyWord}%'");
        }
//        判断0和1的情况必需用三等号
//        if($status ==="1" or $status==="0"){
//            $query->andWhere("status={$status}");
//        }
//        没页显示的条数

//      总条数
        $count=$query->count();
        $searchForm=new GoodsSearchForm();
        $page=new Pagination([
       'pageSize'=>3,
       'totalCount'=>$count
        ]);
   $models=$query->limit($page->limit)->offset($page->offset)->all();
//   $models=Goods::find()->limit($page->limit)->offset($page->offset)->where(['status'=>1])->orderBy('sort')->all();
//        var_dump($models);exit;
//echo 111;exit;
    return $this->render("index", compact("page","models","searchForm"));
    }

    /**
     * @return string|\yii\web\Response
     * 这里是处理商品添加的代码
     */
    public function actionAdd(){
        $model=new Goods();
        $intro=new GoodsIntro();
        $gallery=new GoodsGallery();
        $model->status=1;
        $model->is_on_sale=1;
        $category=GoodsCategory::find()->orderBy('tree','lft')->all();
        //拼接
//        $catesArray=ArrayHelper::map($cates,'id','nameText');
        $category=ArrayHelper::map($category,'id','nameText');
        $brand=Brand::find()->all();
        $brand=ArrayHelper::map($brand,'id','name');
        $request=\Yii::$app->request;
        if($request->isPost) {
//            echo 111;ex


            if ($model->load($request->post()) && $model->validate()) {


//                var_dump($model->load($request->post()));exit;
                $goodsCount = GoodsDayCount::findOne(['day' => date("Ymd", time())]);
//                如果是同一天添加商品就执行下面的goods_day_count
                if (empty($goodsCount)) {
                    $goodsCount = new GoodsDayCount();
//                    var_dump( $goodsCount);exit;
                    $goodsCount->day = date("Ymd", time());

                    $goodsCount->count = 1;
//                var_dump( $goodsCount->count);exit;
                    $goodsCount->save();
                } else {


//                    取出数据加一
                    $count = $goodsCount->count;
//                    var_dump($count);exit;
                    $goodsCount->count = $count + 1;
                    $goodsCount->save();
                }

                $model->inputtime = time();
//                拼接货号

                $model->sn = date("Ymd", time()) . (substr('00000' . $goodsCount->count, -5));
                //var_dump($model->sn);exit  ;
                $model->save();

            }
//            商品简介
            if ($intro->load($request->post()) && $intro->validate()) {
                $intro->goods_id = $model->id;
                $intro->save();

            }
//          var_dump($request->post());exit;
            $goodsGallery = $request->post()['GoodsGallery']['imgFile'];
//            判断是否传多张图片
            if($goodsGallery){
            foreach ($goodsGallery as $v) {
                $gallery = new GoodsGallery();
                $gallery->path = $v;
                $gallery->goods_id = $model->id;
                $gallery->save();
               }
            }
            \Yii::$app->session->setFlash("success", "添加商品成功");
            return $this->redirect(['index']);


        }

     return $this->render('add',['model'=>$model,'intro'=>$intro,'category'=>$category,'brand'=>$brand,'gallery'=>$gallery]);
    }

    /**
     * @param $id 修改商品的id
     * @return string|\yii\web\Response
     * 这里是处理修改商品的代码
     */
    public function actionEdit($id){
        $model=Goods::findOne($id);
        $intro=GoodsIntro::findOne(['goods_id'=>$id]);
        $gallery=new GoodsGallery();
//        $model->status=1;
//        $model->is_on_sale=1;
        $category=GoodsCategory::find()->orderBy('tree','lft')->all();
        $category=ArrayHelper::map($category,'id','name');
        $brand=Brand::find()->all();
        $brand=ArrayHelper::map($brand,'id','name');
        $request=\Yii::$app->request;
        if($request->isPost) {
//            echo 111;ex


            if ($model->load($request->post()) && $model->validate() ) {

                var_dump($model->save());

            }
//            商品详情
            if($intro->load($request->post())&&$intro->validate()){
                $intro->goods_id=$model->id;
                $intro->save();

            }
//          var_dump($request->post());exit;
//            这里是删除修改原多图片的和七牛云上的代码
           if( $goodsPath=GoodsGallery::find()->where(['goods_id'=>$model->id])->all()){
            GoodsGallery::deleteAll(['goods_id'=>$model->id]);
           }
            $goodsGallery=$request->post()['GoodsGallery']['imgFile'];
            foreach ($goodsGallery as $v){
                $gallery=new GoodsGallery();
                $gallery->path=$v;
                $gallery->goods_id=$model->id;
                $gallery->save();
            }
            \Yii::$app->session->setFlash("success","添加商品成功");
            return $this->redirect(['index']);
        }
   $path=GoodsGallery::find()->where(['goods_id'=>$id])->all();
      foreach ($path as $v){
           $gallery->imgFile[]=$v->path;
     }
        return $this->render('add',['model'=>$model,'intro'=>$intro,'category'=>$category,'brand'=>$brand,'gallery'=>$gallery]);
    }
    /**['day' =>date("Ymd",time())]
     * 这里是七牛云上传
     */
    public function actionUploads(){

//配置
        $config = [
            'accessKey'=>'NkkloNQISSZV_oJqRH2QxVojDDzt10WIeey8RfAK',//ak
            'secretKey'=>'1hAaLkHyLwW_ICPwYjGYiWLSePL1g0accVkZxSSG',//sk
            'domain'=>'http://oyvf2pul7.bkt.clouddn.com/',//域名
            'bucket'=>'shangcheng',//空间名称
            'area'=>Qiniu::AREA_HUANAN //区域
        ];


//实列化对象
        $qiniu = new Qiniu($config);
        $key = microtime(true);
//        调用上传方法
        $qiniu->uploadFile($_FILES["file"]['tmp_name'],$key);
        $url = $qiniu->getLink($key);
        $info=[
            'code'=>0,
            'url'=>$url,
            'attachment'=>$url
        ];
        exit(Json::encode($info));

    }

    /**
     * @param $id
     * @return \yii\web\Response
     * 这里是处理删除的代码
     */
  public function actionDel($id){
    $goods=Goods::findOne($id);
   $intro=GoodsIntro::findOne(['goods_id'=>$id]);
   $gallery=GoodsGallery::find()->where(['goods_id'=>$id])->all();
////              这里是删除七牛云多图片的代码
   foreach ($gallery as $v){
       $config = [
           'accessKey'=>'NkkloNQISSZV_oJqRH2QxVojDDzt10WIeey8RfAK',//ak
           'secretKey'=>'1hAaLkHyLwW_ICPwYjGYiWLSePL1g0accVkZxSSG',//sk
           'domain'=>'http://oyvf2pul7.bkt.clouddn.com/',//域名
           'bucket'=>'shangcheng',//空间名称
           'area'=>Qiniu::AREA_HUANAN //区域
       ];
       $qiNiu=new Qiniu($config);
//          var_dump($model->logo);exit;
      $key=substr($v->path,-15);
//      exit($key);exit;
//          var_dump($key);exit;
//                         图片名          空间名称
       $qiNiu->delete($key,"shangcheng");
//      var_dump( $v);exit;


   }
   GoodsGallery::deleteAll(['goods_id'=>$id]);
//    这里是删除goods七牛云上的图片
      $config = [
          'accessKey'=>'NkkloNQISSZV_oJqRH2QxVojDDzt10WIeey8RfAK',//ak
          'secretKey'=>'1hAaLkHyLwW_ICPwYjGYiWLSePL1g0accVkZxSSG',//sk
          'domain'=>'http://oyvf2pul7.bkt.clouddn.com/',//域名
          'bucket'=>'shangcheng',//空间名称
          'area'=>Qiniu::AREA_HUANAN //区域
      ];
      $qiNiu=new Qiniu($config);
//          var_dump($model->logo);exit;
      $key=substr($goods->logo,-10);
//      exit($key);exit;
//          var_dump($key);exit;
//                         图片名          空间名称
      $qiNiu->delete($key,"shangcheng");
      $goods->delete();
      $intro->delete();
      return $this->redirect(['index']);
  }



  public function actionIntro($id){
     $model=GoodsIntro::findOne(['goods_id'=>$id]);

//     显示页面
      return $this->render('intro',['model'=>$model]);
}
}