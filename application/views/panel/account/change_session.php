<div class="mb-3">
    <label for="target_comp_ses" class="form-label">Company</label>
    <select class="form-select select2" id="target_comp_ses" d-url="<?= base_url("account/change_session/switcher-company") ?>" onchange="loadcompses(this)">
        <?php
        foreach ($company as $val) {
            echo "<option value=\"$val->id\">$val->company_name</option>";
        }
        ?>
    </select>
</div>
<div class="mb-3">
    <label for="target_account_session" class="form-label">Target Account</label>
    <select class="form-select select2" id="target_account_session">
        <?php
        foreach ($users as $val) {
            echo "<option value=\"$val->id\">$val->account_name</option>";
        }
        ?>
    </select>
</div>
