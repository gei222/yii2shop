<?php
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'name')->textInput();
echo $form->field($model,'intro')->textarea();
echo $form->field($model,'article_category_id')->dropDownList($items);
echo $form->field($model,'sort')->textInput();
echo $form->field($model,'status',['inline'=>1])->radioList([0=>'隐藏',1=>'正常']);
echo $form->field($details,'content')->textarea();
echo '<input type="submit" class="btn btn-block" value="提交">';
$form=\yii\bootstrap\ActiveForm::end();