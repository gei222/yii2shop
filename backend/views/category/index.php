<a href="<?=\yii\helpers\Url::to(['category/add'])?>" class="btn btn-info">添加数据</a>
<table border="1px" class="table">
    <tr>
        <th>id</th>
        <th>名字</th>
        <th>简介</th>
        <th>排序</th>
        <th>状态</th>
        <th>操作</th>
    </tr>
    <?php foreach ($categorys as $category) : ?>
        <tr>

            <td><?=$category->id?></td>
            <td><?=$category->name?></td>
            <td><?=$category->intro?></td>
            <td><?=$category->sort?></td>
            <td><?=$category->status?></td>
            <td>
                <?=\yii\bootstrap\Html::a('修改',['edit','id'=>$category->id],['class'=>'btn btn-warning'])?>
                <a href="javascript:;" class="btn_del btn btn-primary" data-id="<?=$category->id?>">删除</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<?php
$url = \yii\helpers\Url::to(['category/del']);
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
