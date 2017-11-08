<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/7
 * Time: 10:27
 */

namespace backend\controllers;
use yii\web\Controller;
use backend\models\Gallery;
use yii\web\UploadedFile;
use yii\web\Request;
class GalleryController extends Controller
{
  /**
   * 显示列表
   */
    public function actionIndex()
    {
        $gallerys = Gallery::find()->all();
        //2.调用视图来展示数据
        return $this->render('index', ['gallerys' => $gallerys]);
    }
    /*
     * 添加数据
     */
    public function actionAdd(){
        $model = new Gallery();
        $request=new Request();
      if($request->isPost){
            $model->load($request->post());
            $model->imgFile=UploadedFile::getInstance($model,'imgFile');
            //验证数据
            //var_dump($model->validate())
            if($model->validate()){
                $ext=$model->imgFile->extension;
                $file='/upload/'.uniqid().'.'.$ext;
                $model->imgFile->saveAs(\yii::getAlias('@webroot').$file,0);
                $model->path=$file;
                $model->save(false);
                //跳转页面
                \yii::$app->session->setFlash('success','添加成功');
                return $this->redirect(['goodss/index']);
            }else{

                var_dump($model->getErrors());exit();
            }
        }
        return $this->render('add',['model'=>$model]);
    }
    /*
     * 删除
     */
    public function actionDel(){
        $id = \Yii::$app->request->post('id');
        $model = Gallery::findOne(['id'=>$id]);
        if($model){
            $model->delete();
            return 'success';
        }else{
            return '该记录不存在或已被删除';
        }
    }


}