<?php

namespace backend\controllers;
use backend\models\GoodsCategory;
use yii\data\Pagination;
class GoodsController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $goodss = GoodsCategory::find()->all();
        //2.调用视图来展示数据
        return $this->render('index', ['goodss' => $goodss]);
    }
    public function actionAddCategory()
    {
        $model = new GoodsCategory();
        //parent_id设置默认值
        $model->parent_id = 0;
        $request = \Yii::$app->request;
        if ($request->isPost) {
            $model->load($request->post());
            if ($model->validate()) {
                if ($model->parent_id == 0) {
                    //创建根节点
                    $model->makeRoot();
                    \yii::$app->session->setFlash('success', '添加成功');
                    return $this->redirect(['goods/index']);
                } else {
                    $parent = GoodsCategory::findOne(['id' => $model->parent_id]);
                    $model->prependTo($parent);
                    \yii::$app->session->setFlash('success', '添加成功');
                    return $this->redirect(['goods/index']);
                }
            }
        }
        return $this->render('add-category', ['model' => $model]);
    }
    public function actionEdit($id)
    {
        $model = GoodsCategory::findOne(['id' => $id]);
        //parent_id设置默认值
        $model->parent_id = 0;
        $request = \Yii::$app->request;
        if ($request->isPost) {
            $model->load($request->post());
            if ($model->validate()) {
                if ($model->parent_id == 0) {
                    if($model->getOldAttribute('parent_id')==0){
                       $model->save();
                    }else{
                        $model->makeRoot();
                    }
                    \yii::$app->session->setFlash('success', '修改成功');
                    return $this->redirect(['goods/index']);
                } else {
                    $parent = GoodsCategory::findOne(['id' => $model->parent_id]);
                    $model->prependTo($parent);
                    \yii::$app->session->setFlash('success', '修改成功');
                    return $this->redirect(['goods/index']);
                }

            }
        }
        return $this->render('add-category', ['model' => $model]);
    }

    public function actionDel()
    {
        $id = \Yii::$app->request->post('id');
        $model = GoodsCategory::findOne(['id' => $id]);
//        if($model->isLeaf){
//            if($model->parent_id !=0){
//                $model->delete();
//            }else{
//                $model->deleteWithChildren();
//            }
//            return 'success';
//        }else{
//            return '该记录不存在或已被删除';
//        }
//
//    }
//}
        if ($model->isLeaf()) {
            if ($model->parent_id != 0) {
                $model->delete();
            } else {
                $model->deleteWithChildren();
            }
            return 'success';
        } else {
            //有子节点
            return '该记录不存在或已被删除';
        }
    }
}