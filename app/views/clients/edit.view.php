<form autocomplete="off" class="appForm clearfix" method="post" enctype="application/x-www-form-urlencoded">
    <fieldset>
        <legend><?= $text_legend ?></legend>
        <div class="input_wrapper n50 border">
            <label <?= $this->labelFloat('cat_name', $client) ?> > <?= $text_label_Name ?></label>
            <input required type="text" name="cat_name" maxlength="40" value="<?= $this->showValue('cat_name', $client) ?>">
        </div>
        <div class="input_wrapper n50 padding">
            <label<?= $this->labelFloat('cat_email', $client) ?>><?= $text_label_Email ?></label>
            <input required type="email" name="cat_email" maxlength="40" value="<?= $this->showValue('cat_email', $client) ?>">
        </div>
        <div class="input_wrapper n50 border">
            <label<?= $this->labelFloat('cat_phoneNumber', $client) ?>><?= $text_label_PhoneNumber ?></label>
            <input required type="text" name="cat_phoneNumber" maxlength="15" value="<?= $this->showValue('cat_phoneNumber', $client) ?>">
        </div>
        <div class="input_wrapper n50 padding">
            <label<?= $this->labelFloat('cat_address', $client) ?>><?= $text_label_Address ?></label>
            <input required type="text" name="cat_address" value="<?= $this->showValue('cat_address', $client) ?>">
        </div>
        <input class="no_float" type="submit" name="submit" value="<?= $text_label_save ?>">
    </fieldset>
</form>