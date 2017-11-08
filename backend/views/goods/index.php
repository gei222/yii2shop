<a href="<?=\yii\helpers\Url::to(['goods/add-category'])?>" class="btn btn-info">添加数据</a>
<table border="1px" class="table">
    <tr>
        <th>id</th>
        <th>名字</th>
        <th>简介</th>
        <th>操作</th>
    </tr>
    <?php foreach ($goodss as $goods) : ?>
        <tr>
            <td><?=$goods->id?></td>
            <td><?=$goods->name?></td>
            <td><?=$goods->intro?></td>
            <td>
                <?=\yii\bootstrap\Html::a('修改',['edit','id'=>$goods->id],['class'=>'btn btn-warning'])?>
                <a href="javascript:;" class="btn_del btn btn-primary" data-id="<?=$goods->id?>">删除</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<?php
$url = \yii\helpers\Url::to(['goods/del']);
$this->registerJs(
    <<<js
  $(".btn_del").click(function(){
        if(confirm('是否删除该用户?删除后无法恢复!')){
            var url = "{$url}";
            var id = $(this).attr('data-id');
            var that = this;
            $.post(url,{id:id},function(data){
                if(data == 'success'){
                 
                    $(that).closest('tr').fadeOut();
                }else{
               
                    alert(data);
                }
            });
        }
    });
js
);
?>


