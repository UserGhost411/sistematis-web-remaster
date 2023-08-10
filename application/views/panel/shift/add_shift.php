<div class="mb-3">
    <label for="zdfsa" class="form-label">Account Name</label>
    <select class="form-select select2" id="schedule_account">
        <?php
        foreach ($account as $val) {
            echo "<option value=\"$val->id\">$val->account_name</option>";
        }
        ?>
    </select>
</div>
<div class="mb-3">
    <label for="schedule_shift" class="form-label">Shift</label>
    <select class="form-select select2" id="schedule_shift">
        <?php
        foreach ($shift as $val) {
            echo "<option value=\"$val->id\">$val->shift_name ($val->shift_start - $val->shift_end)</option>";
        }
        ?>
    </select>
</div>