<form autocomplete="off" class="appForm clearfix" method="post" enctype="multipart/form-data">
    <fieldset>
        <legend><?= $text_legend ?></legend>
        <div class="input_wrapper n100">
            <label<?= $this->labelFloat('cat_name') ?>><?= $text_label_Name ?></label>
            <input required type="text" name="cat_name" id="Name" maxlength="20" value="<?= $this->showValue('cat_name') ?>">
        </div>
        <div class="input_wrapper n100">
            <label class="floated"><?= $text_label_Image ?></label>
            <input type="file" name="cat_image" accept="image/*">
        </div>

        <input class="no_float" type="submit" name="submit" value="<?= $text_label_save ?>">
    </fieldset>
</form>