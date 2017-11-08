
<form>
<input type="text" name="">
</form>
<a href="<?=\yii\helpers\Url::to(['goodss/add'])?>" class="btn btn-info">添加数据</a>
<table border="1px" class="table">
    <tr>
        <th>id</th>
        <th>货号</th>
        <th>名字</th>
        <th>商品价格</th>
        <th>库存</th>
        <th>logo</th>
        <th>操作</th>
    </tr>
    <?php foreach ($commoditylist as $commodity) : ?>
        <tr>
            <td><?=$commodity->id?></td>
            <td><?=$commodity->sn?></td>
            <td><?=$commodity->name?></td>
            <td><?=$commodity->shop_price?></td>
            <td><?=$commodity->stock?></td>
            <td><?=\yii\bootstrap\Html::img($commodity->logo,['width'=>'50px'])?></td>
            <td>
                <a href="<?=\yii\helpers\Url::to(['gallery/index'])?>" class="btn btn-info">相册</a>
                <?=\yii\bootstrap\Html::a('修改',['edit','id'=>$commodity->id],['class'=>'btn btn-warning'])?>
                <a href="javascript:;" class="btn_del btn btn-primary" data-id="<?=$commodity->id?>">删除</a>
                <a href="<?=\yii\helpers\Url::to(['intro/index'])?>" class="btn btn-info">商品描述</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<?php
$url = \yii\helpers\Url::to(['goodss/del']);
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
<?php
echo \yii\widgets\LinkPager::widget([
    'pagination'=>$pager,

]);
