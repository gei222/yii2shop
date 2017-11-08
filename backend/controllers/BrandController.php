<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/3 0003
 * Time: 14:11
 */

namespace backend\controllers;
use backend\models\Brand;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\Request;
use yii\web\UploadedFile;
use yii\data\Pagination;
class BrandController extends Controller
{
    public $enableCsrfValidation = false;
    /*
     * 1.显示数据到页面上
     */
    public function actionIndex()
    {
        //1.创建模型实例化数据
        $query =Brand ::find();
        //分页工具类
        $pager = new Pagination();
        $pager->totalCount = $query->count();
        $pager->pageSize = 2;
        // limit 0,2  ====> 两个参数 0(偏移量offset)   , 2(限制数量limit)
        $brands = $query->where(['status'=>1])->limit($pager->limit)->offset($pager->offset)->all();
        //var_dump($brands);exit;
        return $this->render('index',['brands'=>$brands,'pager'=>$pager]);
    }
    /*
     * 添加数据品牌数据
     */
    public function actionAdd()
    {
        //1.1先创建一个表单
        //1.2获取表单提交数据
        //1.3保存表单提交数据
        $model = new Brand();
        $request = new Request();
        if ($request->isPost) {
            $model->load($request->post());
            $model->logo = UploadedFile::getInstanceByName('file');
            //验证数据
            //var_dump($model->validate())
            if ($model->validate()) {
                $fileName = '/upload/'.uniqid().'.'.$model->extension;
//                $ext = $model->imgFile->extension;
//                $file = '/upload/' . uniqid() . '.' . $ext;
                $model->logo->saveAs(\yii::getAlias('@webroot') . $fileName, 0);
                return Json::encode(['url'=>$fileName]);
                $model->logo = $fileName;
                $model->save();
                //跳转页面
                \yii::$app->session->setFlash('success', '添加成功');
                return $this->redirect(['brand/index']);
            } else {
                var_dump($model->getErrors());
                exit();
            }
        }
        return $this->render('add', ['model' => $model]);
    }
    /*
     * 修改
     */
    //1.1根据id删除一条数据
    //1.2处理修改表单数据
    //1.3保存修改表单数据
//    public function actionEdit($id)
//    {
//        $model = Brand::findOne(['id' => $id]);
//        $request = new Request();
//        if ($request->isPost) {
//            $model->load($request->post());
//            $model->imgFile = UploadedFile::getInstance($model, 'imgFile');
//            if ($model->validate()) {
//                $ext = $model->imgFile->extension;
//                $file = '/upload/' . uniqid() . '.' . $ext;
//                $model->imgFile->saveAs(\yii::getAlias('@webroot') . $file, 0);
//                $model->logo = $file;
//                $model->save(false);
//                \yii::$app->session->setFlash('success', '修改成功');
//                return $this->redirect(['brand/index']);
//            } else {
//                var_dump($model->getErrors());
//                exit();
//            }
//        }
//        return $this->render('add', ['model' => $model]);
//    }
//
    public function actionDel(){
        $id = \Yii::$app->request->post('id');
        $model = Brand::findOne(['id'=>$id]);
        if($model){
            $model->status=-1;
            $model->save();
            return 'success';
        }else{
            return '该记录不存在或已被删除';
        }

    }
}
