<a href="<?=\yii\helpers\Url::to(['article/add'])?>" class="btn btn-info">添加数据</a>
<table border="1px" class="table">
    <tr>
        <th>id</th>
        <th>名称</th>
        <th>简介</th>
        <th>文章分类id</th>
        <th>排序</th>
        <th>状态</th>
        <th>创建时间</th>
        <th>操作</th>
    </tr>
    <?php foreach ($articles as $article) : ?>
        <tr>
            <td><?=$article->id?></td>
            <td><?=$article->name?></td>
            <td><?=$article->intro?></td>
            <td><?=$article->article_category_id?></td>
            <td><?=$article->sort?></td>
            <td><?=$article->status?></td>
            <td><?=date('Y-m-d H:i:s',$article->create_time)?></td>
            <td>
                <?=\yii\bootstrap\Html::a('修改',['edit','id'=>$article->id],['class'=>'btn btn-warning'])?>
                <a href="javascript:;" class="btn_del btn btn-primary" data-id="<?=$article->id?>">删除</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<?php
$url = \yii\helpers\Url::to(['article/del']);
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

