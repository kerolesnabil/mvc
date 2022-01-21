<form autocomplete="off" class="appForm clearfix" method="post" enctype="application/x-www-form-urlencoded">
    <fieldset>
        <legend><?= $text_legend ?></legend>
        <div class="input_wrapper n50 border">
            <label <?= $this->labelFloat('cat_name', $supplier) ?> > <?= $text_label_Name ?></label>
            <input required type="text" name="cat_name" maxlength="40" value="<?= $this->showValue('cat_name', $supplier) ?>">
        </div>
        <div class="input_wrapper n50 padding">
            <label<?= $this->labelFloat('cat_email', $supplier) ?>><?= $text_label_Email ?></label>
            <input required type="email" name="cat_email" maxlength="40" value="<?= $this->showValue('cat_email', $supplier) ?>">
        </div>
        <div class="input_wrapper n50 border">
            <label<?= $this->labelFloat('cat_phoneNumber', $supplier) ?>><?= $text_label_PhoneNumber ?></label>
            <input required type="text" name="cat_phoneNumber" maxlength="15" value="<?= $this->showValue('cat_phoneNumber', $supplier) ?>">
        </div>
        <div class="input_wrapper n50 padding">
            <label<?= $this->labelFloat('cat_address', $supplier) ?>><?= $text_label_Address ?></label>
            <input required type="text" name="cat_address" value="<?= $this->showValue('cat_address', $supplier) ?>">
        </div>
        <input class="no_float" type="submit" name="submit" value="<?= $text_label_save ?>">
    </fieldset>
</form>