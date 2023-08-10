<input type="hidden" id="checklist_id" value="<?= $data->id ?>">

<div class="mb-3">
    <label for="checklist_name" class="form-label">Checklist Name</label>
    <input type="text" class="form-control" id="checklist_name" value="<?= htmlspecialchars($data->checklist_name) ?>" placeholder="Enter Checklist Name" required>
</div>

<div class="mb-3">
    <label for="checklist_device" class="form-label">Device</label>
    <select class="form-select select2" id="checklist_device">
        <option value="0">Non-Device</option>
        <?php
        foreach ($device as $val) {
            echo "<option value=\"$val->id\" " . ($data->checklist_device == $val->id ? "selected" : "") . ">$val->device_name </option>";
        }
        ?>
    </select>
</div>

<div class="mb-3">
    <label for="checklist_shift" class="form-label">Shift</label>
    <select class="form-select select2" id="checklist_shift">
        <?php
        foreach ($shift as $val) {
            echo "<option value=\"$val->id\" " . ($data->checklist_shift == $val->id ? "selected" : "") . ">$val->shift_name ($val->shift_start - $val->shift_end)</option>";
        }
        ?>
    </select>
</div>
<div class="mb-3">
    <label for="checklist_repeat" class="form-label">Repeat</label>
    <select class="form-select" id="checklist_repeat" onchange="checkrepeat(this.value)">
        <option value="0" <?= ($data->checklist_repeat == 0 ? "selected" : "") ?>>Daily</option>
        <option value="1" <?= ($data->checklist_repeat == 1 ? "selected" : "") ?>>Weekly</option>
        <option value="2" <?= ($data->checklist_repeat == 2 ? "selected" : "") ?>>Monthly</option>
        <option value="3" <?= ($data->checklist_repeat == 3 ? "selected" : "") ?>>3 Monthly</option>
        <option value="4" <?= ($data->checklist_repeat == 4 ? "selected" : "") ?>>6 Monthly</option>
    </select>
</div>
<div class="mb-3" id="ac">
    <label for="checklist_repeat_info" class="form-label" id="ac_rep">Repeat</label>
    <input type="number" class="form-control" id="checklist_repeat_info" value="<?= htmlspecialchars($data->checklist_repeat_info) ?>" placeholder="Enter Checklist Location" value="0" required>
</div>
<div class="mb-3">
    <label for="checklist_desc" class="form-label">Checklist Information</label>
    <textarea type="text" class="form-control" id="checklist_desc" placeholder="Enter Checklist Information" required><?= htmlspecialchars($data->checklist_desc) ?></textarea>
</div>
<script>
    checkrepeat(<?= $data->checklist_repeat ?>);

    function checkrepeat(a) {
        if (a == 0) {
            document.getElementById("ac").style.display = "none";
        } else {
            const reps = ["", "Repeat on Day (0=sunday,1=monday,... etc)", "Repeat on Date (1=every 1st date)", "Repeat on Date (1=every 1st date)", "Repeat on Date (1=every 1st date)"]
            document.getElementById("ac").style.display = "block";
            document.getElementById("ac_rep").innerHTML = reps[a];
        }
    }
</script>