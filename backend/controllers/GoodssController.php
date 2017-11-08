<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/6
 * Time: 14:26
 */
namespace backend\controllers;
use backend\models\Brand;
use backend\models\GoodsCategory;
use kucha\ueditor\UEditorAction;
use yii\web\Controller;
use backend\models\Goodss;
use yii\data\Pagination;
use yii\web\Request;
use yii\web\UploadedFile;
use backend\models\Intro;
use backend\models\Count;
class GoodssController extends Controller
{
//显示列表
  public function actionIndex(){
      $query =Goodss ::find();
      /*
       * 搜索数据
       */
      //1.跟据id查询出数据库的数据
      //分页工具类
      $pager = new Pagination();
      $pager->totalCount = $query->count();
      $pager->pageSize = 3;
      // limit 0,2  ====> 两个参数 0(偏移量offset)   , 2(限制数量limit)
      $commoditylist = $query->where(['is_on_sale'=>1])->limit($pager->limit)->offset($pager->offset)->all();
//      var_dump($commoditylist);exit;
       return $this->render('index',['commoditylist'=>$commoditylist,'pager'=>$pager]);
//      $commoditylist = Goodss::find()->all();
//      //2.调用视图来展示数据
//      return $this->render('index', ['commoditylist' => $commoditylist]);
//      var_dump($commoditylist);exit;
  }
  /**
   *添加表单数据
   */
  public function actionAdd()
  {
      $model = new goodss();//商品模型
      $goodscategory = new GoodsCategory();//无限极分类
      $intros=new Intro();//商品详情模型
      //  var_dump($goodscategory);exit();
//      $cut=new Count();
//      $date=date('Y-m-d',time());
//      if($cut->findOne(["id"=>$date])){
//          $count=$cut->findOne(["id"=>$date])->count +1;
//      }else{
//          $cut->id=date('Y-m-d',time());
//          $cut->count=0;
//          $cut->save();
//          $count=1;
//      }
//     $count=sprintf('%4s',$count);


//      var_dump($request);exit();
      $request = new Request;
      if ($request->isPost) {
//         echo '1212';exit();
          $model->load($request->post());
          $model->imgFile=UploadedFile::getInstance($model,'imgFile');
          $goodscategory->load($request->post());
          $intros->load($request->post());
//          var_dump($goodscategory);exit();
          if ($model->validate() && $intros->validate()) {
//              echo'21212';exit;
//              echo '12212'; $ext=$model->imgFile->extension;
              $ext = $model->imgFile->extension;
//              var_dump($ext);exit();
              $file = '/upload/' . uniqid() . '.' . $ext;
              $model->imgFile->saveAs(\yii::getAlias('@webroot') . $file, 0);
              $model->logo = $file;
              $model->save(false);
              $intros->goods_id = $model->id;
              $intros->save();

//              $sn=Count::findOne(["id"=>$cut]);
//              $sn->count=$count;
//              $sn->save();
              //数据图片上传成功跳转到相册
              //跳转
              \yii::$app->session->setFlash('success', '添加成功');
              return $this->redirect(['gallery/index']);
          }else {
             \yii::$app->session->setFlash('success', '添加成功');
             return $this->redirect(['gallery/index']);
          }
      }
      $items = [];
      $brands =Brand ::find()->asArray()->all();
      foreach ($brands as $arr) {
//          echo '121212';exit();
          $items[$arr['id']] = $arr['name'];
      }
//          echo '121212';exit();
          return $this->render('add', ['model' => $model, 'goodscategory' => $goodscategory,'items' => $items,'intros'=>$intros]);
      }
  /**
   * 修改
   */
    public function actionEdit($id){
        $model = Goodss::findOne(['id' => $id]);
        $intros=Intro::findOne(['goods_id'=>$id]);
        $goodscategory = new GoodsCategory();
//        $intros=new Intro();
        //  var_dump($goodscategory);exit();
        $request = new Request;
//      var_dump($request);exit();
        if ($request->isPost) {
//         echo '1212';exit();
            $model->load($request->post());
            $model->imgFile=UploadedFile::getInstance($model,'imgFile');
            $goodscategory->load($request->post());
            $intros->load($request->post());
//          var_dump($goodscategory);exit();
            if ($model->validate() && $intros->validate()) {
//              echo'21212';exit;
//              echo '12212'; $ext=$model->imgFile->extension;
                $ext=$model->imgFile->extension;
//              var_dump($ext);exit();
                $file='/upload/'.uniqid().'.'.$ext;
                $model->imgFile->saveAs(\yii::getAlias('@webroot').$file,0);
                $model->logo=$file;
                $model->save(false);
                $intros->goods_id=$model->id;
               // var_dump($intros);exit();
                $intros->save();
                //跳转
                \yii::$app->session->setFlash('success', '添加成功');
                return $this->redirect(['gallery/index']);
            } else {
                \yii::$app->session->setFlash('success', '添加成功');
                return $this->redirect(['gallery/index']);
            }
        }
        $items = [];
        $brands =Brand ::find()->asArray()->all();
        foreach ($brands as $arr) {

//          echo '121212';exit();
            $items[$arr['id']] = $arr['name'];
        }
//          echo '121212';exit();
        //var_dump($intros);exit();
        return $this->render('add', ['model' => $model, 'goodscategory' => $goodscategory,'items' => $items,'intros'=>$intros]);
    }
  /**
   *删除
   */
    public function actionDel(){
        $id = \Yii::$app->request->post('id');
        $model = Goodss::findOne(['id'=>$id]);
        if($model){
            $model->delete();
            return 'success';
        }else{
            return '该记录不存在或已被删除';
        }

    }
    public function actions()
    {
        return [
            'upload' => [
                //'class' => 'kucha\ueditor\UEditorAction',
                "class"=>UEditorAction::className(),
                'config' => [
                    "imageUrlPrefix"  => "http://admin.yiishop.com",//图片访问路径前缀
                    "imagePathFormat" => "/upload/{yyyy}{mm}{dd}/{time}{rand:6}", //上传保存路径
                    //"imageRoot" => Yii::getAlias("@webroot"),
                ]
            ]
        ];
    }
}