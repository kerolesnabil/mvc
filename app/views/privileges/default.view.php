<div class="container">
    <a href="/privileges/create" class="button"> <i class="fa fa-plus" ></i> <?= $text_new_item ?>  </a>
    <table class="data" >
        <thead>
            <tr>
                <th><?= $text_table_privilege?></th>
                <th><?= $text_table_control ?></th>
            </tr>
        </thead>
        <tbody>
        <?php if(false !==$privileges) : foreach ($privileges as $privilege) : ?>
            <tr>
                <td>
                    <?=$privilege->privilege_title  ?>
                </td>
                <td>
                    <a href="/privileges/edit/<?=$privilege->privilege_id ?>"><i class="fa fa-edit"></i></a>
                    <a href="/privileges/delete/<?= $privilege->privilege_id ?>"
                       onclick="if(!confirm('<?= $text_table_control_delete_confirm ?>'))return false;">
                        <i class="fa fa-trash"> </i></a>
                </td>
            </tr>
        <?php endforeach; endif;     ?>
        </tbody>
    </table>
</div>
