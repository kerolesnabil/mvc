<form autocomplete="off" class="appForm clearfix" method="post" enctype="multipart/form-data">
    <fieldset>
        <legend><?= $text_legend ?></legend>
        <div class="input_wrapper n100">
            <label<?= $this->labelFloat('cat_name', $category) ?>><?= $text_label_Name ?></label>
            <input required type="text" name="cat_name" id="cat_name" maxlength="20" value="<?= $this->showValue('cat_name', $category) ?>">

        </div>
        <div class="input_wrapper n100">
            <label class="floated"><?= $text_label_Image ?></label>
            <input type="file" name="cat_image" accept="image/*">
        </div>
        <?php if ($category->cat_image !== ''): ?>
            <div class="input_wrapper_other n100">
                <img src="/uploads/images/<?= $category->cat_image ?>" width="30%">
            </div>
        <?php endif; ?>
        <input class="no_float" type="submit" name="submit" value="<?= $text_label_save ?>">
    </fieldset>
</form>