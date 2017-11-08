<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/7
 * Time: 11:44
 */

namespace backend\controllers;
use yii\web\Controller;
use backend\models\Intro;
class IntroController extends Controller
{
   /**
    * 显示详情列表
    */
   public function actionIndex(){
       $intros = Intro::find()->all();
       //2.调用视图来展示数据
       return $this->render('index', ['intros' => $intros]);
   }

}