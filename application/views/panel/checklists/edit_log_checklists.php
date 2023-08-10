<input type="hidden" id="checklist_data_id" value="<?= $data->id ?>">
<div class="mb-3">
    <label for="checklist_actor" class="form-label">Account Name</label>
    <select class="form-select select2" id="checklist_actor">
        <?php
        foreach ($account as $val) {
            echo "<option value=\"$val->id\" ".($val->id==$data->checklist_actor?"selected":"").">$val->account_name</option>";
        }
        ?>
    </select>
</div>
<div class="mb-3">
    <label for="checklist_id" class="form-label">Checklist</label>
    <select class="form-select select2" id="checklist_id">
        <?php
        foreach ($checklist as $val) {
            echo "<option value=\"$val->id\" ".($val->id==$data->checklist_id?"selected":"").">$val->checklist_name</option>";
        }
        ?>
    </select>
</div>
<div class="mb-3">
    <label for="checklist_status" class="form-label">Repeat</label>
    <select class="form-select" id="checklist_status">
        <option value="0" <?= (0==$data->checklist_status?"selected":"") ?>>Error</option>
        <option value="1" <?= (1==$data->checklist_status?"selected":"") ?>>Fine</option>
    </select>
</div>