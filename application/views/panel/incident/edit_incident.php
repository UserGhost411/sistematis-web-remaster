<input type="hidden" id="incident_id" value="<?= $data->id ?>">

<div class="mb-3">
    <label for="incident_name" class="form-label">Incident Name</label>
    <input type="text" class="form-control" id="incident_name" value="<?= htmlspecialchars($data->incident_name) ?>" placeholder="Enter Incident Name" required>
</div>
<div class="mb-3">
    <label for="incident_device" class="form-label">Incident Device</label>
    <select class="form-select select2" id="incident_device">
        <option value="0">Non-Device</option>
        <?php
        foreach ($devices as $val) {
            echo "<option value=\"$val->id\" ".($val->id==$data->incident_device?"selected":"").">$val->device_name</option>";
        }
        ?>
    </select>
</div>
<div class="mb-3">
    <label for="incident_status" class="form-label">Incident Status</label>
    <select class="form-select" id="incident_status">
        <option value="0" <?= ($data->incident_status == 0 ? "selected" : "") ?>>On Progress</option>
        <option value="1" <?= ($data->incident_status == 1 ? "selected" : "") ?>>Done</option>
        <option value="2" <?= ($data->incident_status == 2 ? "selected" : "") ?>>Hold</option>
    </select>
</div>