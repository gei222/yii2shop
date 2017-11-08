
<?php
/**
 * @var $this \yii\web\view
 */
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'name')->textInput();
echo $form->field($model,'intro')->textarea();
//!加载文件 webuploader
$this->registerCssFile('@web/webuploader/webuploader.css');
$this->registerjsFile('@web/webuploader/webuploader.js',[
    'depends'=>\yii\web\JqueryAsset::className(),
    ]);
$url=\yii\helpers\url::to(['add']);

$this->registerJs(
    <<<JS
// 初始化Web Uploader
var uploader = WebUploader.create({

    // 选完文件后，是否自动上传。
    auto: true,

    // swf文件路径
    swf: '/js/Uploader.swf',

    // 文件接收服务端。
    server: '{$url}',

    // 选择文件的按钮。可选。
    // 内部根据当前运行是创建，可能是input元素，也可能是flash.
    pick: '#filePicker',

    // 只允许选择图片文件。
    accept: {
        title: 'Images',
        extensions: 'gif,jpg,jpeg,bmp,png',
        mimeTypes: 'image/jpg,image/jpeg,image/png',//弹出选择框慢的问题
        
    }
});
//文件上传成功  回显图片
uploader.on( 'uploadSuccess', function( file ,response) {
 
    $("#img").attr('src',response.url);
    //将图片地址写入logo
    $("#brand-logo").val(response.url);
});
JS
);
?>
<div id="uploader-demo">
        <div id="fileList" class="uploader-list"></div>
        <div id="filePicker">选择文件</div>
<div><img id="img"/></div>
<?php
//echo $form->field($model,'imgFile')->fileInput();
echo $form->field($model,'logo')->hiddenInput();
echo $form->field($model,'sort')->textInput();
echo $form->field($model,'status',['inline'=>1])->radioList([0=>'隐藏',1=>'正常']);
echo '<input type="submit" class="btn btn-block" value="提交">';
\yii\bootstrap\ActiveForm::end();