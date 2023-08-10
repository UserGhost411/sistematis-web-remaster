<div class="mb-3">
    <label for="device_name" class="form-label">Device Name</label>
    <input type="text" class="form-control" id="device_name" placeholder="Enter Device Name" required>
</div>
<div class="mb-3">
    <label for="device_location" class="form-label">Device Location</label>
    <input type="text" class="form-control" id="device_location" placeholder="Enter Device Location" required>
</div>
<?php if($this->userdata->account_company==1){ ?>
<div class="mb-3">
    <label for="device_company" class="form-label">Company Owner</label>
    <select class="form-select select2" id="device_company">
        <?php
        foreach ($company as $val) {
            echo "<option value=\"" . $val->id . "\">" . $val->company_name . "</option>";
        }
        ?>
    </select>
</div>
<?php } ?>
<div class="mb-3">
    <label for="device_status" class="form-label">Device Status</label>
    <select class="form-select" id="device_status">
        <option value="1">Fine</option>
        <option value="0">Problem</option>
    </select>
</div>