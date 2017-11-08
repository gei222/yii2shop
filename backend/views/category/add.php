
<?php
$form=\yii\widgets\ActiveForm::begin();
echo $form->field($model,'name')->textInput()->label('名称');
echo $form->field($model,'intro')->textarea()->label('简介');
echo $form->field($model,'sort')->textInput()->label('排序');
echo $form->field($model,'status')->radioList([0=>'隐藏',1=>'正常']);
echo '<input type="submit" class="btn btn-block" value="提交">';
\yii\widgets\ActiveForm::end();