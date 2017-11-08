<a href="<?=\yii\helpers\Url::to(['gallery/add'])?>" class="btn btn-info">添加图片</a>
<table border="1px" class="table">
    <tr>
        <th>path</th>
        <th>操作</th>
    </tr>
    <?php foreach ($gallerys as $gallery) : ?>
        <tr>
            <td><?=\yii\bootstrap\Html::img($gallery->path)?></td>
            <td>
                <a href="<?=\yii\helpers\Url::to(['goodss/index'])?>" class="btn btn-info">商品列表</a>
                <a href="javascript:;" class="btn_del btn btn-primary" data-id="<?=$gallery->id?>">删除</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<?php
$url = \yii\helpers\Url::to(['gallery/del']);
$this->registerJs(
    <<<js
  $(".btn_del").click(function(){
        if(confirm('是否删除该用户?删除后无法恢复!')){
            var url = "{$url}";
            var id = $(this).attr('data-id');
            var that = this;
            $.post(url,{id:id},function(data){
                if(data == 'success'){
                    //删除成功
                    //alert('删除成功');
                    $(that).closest('tr').fadeOut();
                }else{
                    //删除失败
                    alert(data);
                }
            });
        }
    });
js
);
?>


