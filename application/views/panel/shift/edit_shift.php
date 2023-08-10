<input type="hidden" id="schedule_id" value="<?= $data->id ?>">
<div class="mb-3">
    <label for="zdfsa" class="form-label">Account Name</label>
    <input type="text" class="form-control" id="zdfsa" value="<?= htmlspecialchars($account->account_name) ?>" readonly>
</div>
<div class="mb-3">
    <label for="schedule_shift" class="form-label">Shift</label>
    <select class="form-select select2" id="schedule_shift">
        <?php
        foreach ($shift as $val) {
            echo "<option value=\"$val->id\" " . ($val->id == $data->schedule_shift ? "selected" : "") . ">$val->shift_name ($val->shift_start - $val->shift_end)</option>";
        }
        ?>
    </select>
</div>