<?php
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'sn')->textInput();
echo $form->field($model,'name')->textInput();
echo $form->field($model,'imgFile')->fileInput();
echo $form->field($model,'goods_category_id')->hiddenInput();
//加载ztree静态资源 css js
$this->registerCssFile('@web/zTree/css/zTreeStyle/zTreeStyle.css');
$this->registerJsFile('@web/zTree/js/jquery.ztree.core.js',[
    'depends'=>\yii\web\JqueryAsset::className()
]);
$nodes = \yii\helpers\Json::encode(\backend\models\GoodsCategory::getZtreeNodes());
$this->registerJs(
    <<<JS
var zTreeObj;
        // zTree 的参数配置，深入使用请参考 API 文档（setting 配置详解）
        var setting = {
            callback:{
                onClick: function(event, treeId, treeNode){
                    //获取被点击节点的id
                    var id= treeNode.id;
                    //alert(treeNode.tId + ", " + treeNode.name);
                    //将id写入parent_id的值
                    $("#goodss-goods_category_id").val(id);
                }
            }
            ,
            data: {
                simpleData: {
                    enable: true,
                    idKey: "id",
                    pIdKey: "parent_id",
                    rootPId: 0
                }
            }
        };
        // zTree 的数据属性，深入使用请参考 API 文档（zTreeNode 节点数据详解）
        var zNodes = {$nodes};
        zTreeObj = $.fn.zTree.init($("#treeDemo"), setting, zNodes);
        //展开所有节点
        zTreeObj.expandAll(true);
        //选中节点(回显)
        //获取节点  ,根据节点的id搜索节点
        var node = zTreeObj.getNodeByParam("id","{$model->goods_category_id}", null);
        zTreeObj.selectNode(node);
JS
);
echo '<div>
    <ul id="treeDemo" class="ztree"></ul>
</div>';
echo $form->field($model,'brand_id')->dropDownList($items);
echo $form->field($model,'market_price')->textInput();
echo $form->field($model,'shop_price')->textInput();
echo $form->field($model,'stock')->textInput();
echo $form->field($model,'is_on_sale')->radioList([0=>'下架',1=>'上架']);
echo $form->field($model,'sort')->textInput()->label('排序');
//echo $form->field($model,'colum')->widget('kucha\ueditor\UEditor',[]);
echo $form->field($intros,'content' )->widget('kucha\ueditor\UEditor',[]);
echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-info']);
\yii\bootstrap\ActiveForm::end();
