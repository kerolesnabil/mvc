<div class="container">
    <a href="/users/create" class="button"> <i class="fa fa-plus" ></i> <?= $text_new_item ?>  </a>
    <table class="data" >
        <thead>
            <tr>
                <th><?= $text_table_username ?></th>
                <th><?= $text_table_group ?></th>
                <th><?= $text_table_email ?></th>
                <th><?= $text_table_subscription_date ?></th>
                <th><?= $text_table_last_login ?></th>
                <th><?= $text_table_control ?></th>
            </tr>
        </thead>
        <tbody>
        <?php if(false !==$users) : foreach ($users as $user) : ?>
            <tr>
                <td> <?=$user->user_name  ?> </td>
                <td> <?=$user->group_name ?> </td>
                <td> <?=$user->email	 ?> </td>
                <td> <?=$user->subscription_date ?> </td>
                <td> <?=$user->last_login ?> </td>
                <td>
                    <a href="/users/edit/<?=$user->user_id ?>"><i class="fa fa-edit"></i></a>
                    <a href="/users/delete/<?= $user->user_id ?>"
                       onclick="if(!confirm('<?= $text_table_control_delete_confirm ?>'))return false;">
                        <i class="fa fa-trash"> </i></a>

                </td>
            </tr>
        <?php endforeach; endif;     ?>
        </tbody>
    </table>
</div>
