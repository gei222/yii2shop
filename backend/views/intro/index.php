
<table border="1px" class="table">
    <tr>
        <th>商品描述</th>
    </tr>
    <?php foreach ($intros as $intro) : ?>
        <tr>
            <td><?=$intro->content?></td>
        </tr>
    <?php endforeach; ?>
</table>

