
## 项目介绍
```
1.1项目描述简介
类似京东商城的B2C商城
C2C 客户对客户
B2B  
O2O 线上对线下
P2P 
ERP 
CRM 客户关系管理
1.2主要功能模块
系统包括：
后台：品牌管理、商品分类管理、订单管理、系统管理和会员管理六个功能模块。
前台：首页、商品展示、商品购买、订单管理、在线支付等。
1.3 开发环境和技术

```

<table border=1px>
<tr><th>开发环境</th><th>开发工具</th><th>相关技术</th></tr>
<tr><td>window</td><td>phpstorm+php7.0+git+apache</td><td>yii2+CDN+jquery</td></tr>
</table>

##  品牌功能模块
```
3.1.需求
品牌管理功能涉及品牌的列表展示，品牌添加，修改，删除功能。
品牌需要保存缩略图和简介。
品牌删除使用逻辑删除。
设置一个状态为1表示显示0表示隐藏两次0表示彻底删除

```
## 文章功能模块
```
1.创建三个表 文章分类表 、文章表、 内容表
文章分类表：
  创建一个状态为来表示显示或者隐藏
  同是也创建一个状态为来把文章分类在分类分为服务类和活动类
  文章分类名称
  分类简介
文章表：
  创建一个状态位分类id来使文章与分类建立联系
  在显示文章添加的时候要先判断分类的状态位显示的可以选择
  文章名
  文章简介
  文章录入时间
内容表：
  创建与文章内容相关的id使文章与内容链接起来
  内容

```
## 问题
```
 我的器牛云安装不上百度上传都安装不上；
 
```
### 分类管理


## 需求
```
1、分类的增删改查
2、无限极分类ztree

```
## 流程
```angular2html
1、先把增删改查的基本功能完成
2、在编辑的时候级别高的不能修改的级别低的下面
3、在显示的时候需要显示级别的关系
4、删除在删除的时候有子类的不能删除和父节点也可以删除
```
## 问题

## 商品管理
## 1、需求
```angular2html
1、商品的增删改查
2、货号是当添加商品的时候就自动生成
3、商品详情需要富文本编辑器
4、列表页可以进行搜索
```
## 2、流程
```
1、先创建四个表
   goods_day_count
   goods
   goods_intro
   goods_gallery
2、在做添加goods表的时候在添加页面就把添加详情和多图片一起完成
3、富文本框用插件完成
4、删除在删除goods表的时候其它表的所有数据也一并删除   
```
##3、问题
```angular2html
多图片回显的时候
     }
     控制器
   $path=GoodsGallery::find()->where(['goods_id'=>$id])->all();
      foreach ($path as $v){
           $gallery->imgFile[]=$v->path;
     }
     视图
     echo $form->field($gallery,'imgFile')->widget('manks\FileInput', [
         'clientOptions' => [
             'pick' => [
                 'multiple' => true,
             ],
             'server' =>\yii\helpers\Url::to(['uploads']),
             'accept' => [
                 'extensions' => 'gif,jpg,jpeg,bmp,png',
              ],
         ],
     ]);
     imgFile不能命名和数据库一样的图片字段不然就会报错
     总结：在给图片命名的时候还是一般不要与数据库的图片命名一样
```
## RBAC
```angular2html
1、权限控制需求
   每个用户拥有不同的权限
   每个用户必需登录才能访问后台
   左侧菜单自动显示
   
```
## 流程
```angular2html
1、首先用数据迁移生成4个表自带的在yii2授权安全中
2、在用插件mdmsoft/yii2-admin 生成RBAC
3、根据数据迁移生成yii migrate --migrationPath=@mdm/admin/migrations生成menu表
4、根据mdm\admin\components\MenuHelper::getAssignedMenu()在主配置文件中设置生成自动左边权限菜单显示
```
## 设计要点与难点
难点：授权的权限在左边的自动显示
解决根据插件实现

