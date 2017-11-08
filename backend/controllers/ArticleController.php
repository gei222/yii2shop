<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/3 0003
 * Time: 16:59
 */

namespace backend\controllers;

use backend\models\Article;
use backend\models\Detail;
use yii\web\Controller;
use yii\web\Request;
use yii\data\Pagination;
use backend\models\Category;
class ArticleController extends Controller
{
    /*
     * 显示数据数据
     */
    public function actionIndex()
    {
        //1.创建模型实例化数据
        //1.创建模型实例化数据
        $query = Article::find();
        //分页工具类
        $pager = new Pagination();
        $pager->totalCount = $query->count();
        $pager->pageSize = 2;
        // limit 0,2  ====> 两个参数 0(偏移量offset)   , 2(限制数量limit)
        $articles = $query->where(['status' => 1])->limit($pager->limit)->offset($pager->offset)->all();
        return $this->render('index', ['articles' => $articles, 'pager' => $pager]);
    }

    /*
     * 添加数据
     */
    public function actionAdd()
    {
        //先创建一个表单
        //接收表单提交数据
        //保存表单提交数据
        $model = new Article();
        $details = new Detail();
        $request = new Request();
        if ($request->isPost) {
//
            $model->load($request->post());
            $details->load($request->post());
            //验证数据
            if ($model->validate() && $details->validate()) {
//            echo'122121';exit;
                $model->create_time = time();
                $model->save();
                $details->article_id = $model->id;
                $details->save();
                //跳转页面
                \yii::$app->session->setFlash('success', '添加成功');
                return $this->redirect(['article/index']);
            } else {
                var_dump($model->getErrors() && $details->getErrors());
                exit();
            }
        }
        $items = [];
        $categorys = Category::find()->asArray()->all();
        foreach ($categorys as $category) {
//        var_dump($category);exit;
            $items[$category['id']] = $category['name'];
        }
        return $this->render('add', ['model' => $model, 'details' => $details, 'items' => $items]);
    }
    /*
    * 修改
    */
    //1.1根据id删除一条数据
    //1.2处理修改表单数据
    //1.3保存修改表单数据
    public function actionEdit($id)
    {
        $model = Article::findOne(['id' => $id]);
//        $model = Article::findOne(['id' => $id]);
        $details = Detail::findOne(['article_id' => $id]);
        $request = new Request();
        if ($request->isPost) {
//
            $model->load($request->post());
            $details->load($request->post());
            //验证数据
            if ($model->validate() && $details->validate()) {
//            echo'122121';exit;
                $model->create_time = time();
                $model->save();
                $details->article_id = $model->id;
                $details->save();
                //跳转页面
                \yii::$app->session->setFlash('success', '添加成功');
                return $this->redirect(['article/index']);
            } else {
                var_dump($model->getErrors() && $details->getErrors());
                exit();
            }
        }

        $items = [];
        $categorys = Category::find()->asArray()->all();
        foreach ($categorys as $category) {
//        var_dump($category);exit;
            $items[$category['id']] = $category['name'];
        }
        return $this->render('add', ['model' => $model, 'details' => $details, 'items' => $items]);
    }


    public function actionDel(){
        $id = \Yii::$app->request->post('id');
        $model = Article::findOne(['id'=>$id]);
        if($model){
            $model->status=-1;
            $model->save();
            return 'success';
        }else{
            return '该记录不存在或已被删除';
        }

    }
}
