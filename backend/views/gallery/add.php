<?php
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'imgFile')->fileInput();
echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-info']);
$form=\yii\bootstrap\ActiveForm::end();