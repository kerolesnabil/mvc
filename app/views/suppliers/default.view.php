<div class="container">
    <a href="/suppliers/create" class="button"><i class="fa fa-plus"></i> <?= $text_new_item ?></a>
    <table class="data">
        <thead>
            <tr>
                <th><?= $text_table_name ?></th>
                <th><?= $text_table_email ?></th>
                <th><?= $text_table_phone_number ?></th>
                <th><?= $text_table_control ?></th>
            </tr>
        </thead>
        <tbody>
        <?php if(false !== $suppliers): foreach ($suppliers as $supplier): ?>
            <tr>
                <td><?= $supplier->cat_name ?></td>
                <td><?= $supplier->cat_email ?></td>
                <td><?= $supplier->cat_phoneNumber ?></td>
                <td>
                    <a href="/suppliers/edit/<?= $supplier->cat_supplier_id ?>"><i class="fa fa-edit"></i></a>
                    <a href="/suppliers/delete/<?= $supplier->cat_supplier_id ?>" onclick="if(!confirm('<?= $text_table_control_delete_confirm ?>')) return false;"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        <?php endforeach; endif; ?>
        </tbody>
    </table>
</div>