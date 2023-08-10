<input type="hidden" id="access_id" value="<?= $data->id ?>">

<div class="mb-3">
    <label for="access_namespace" class="form-label">Permission</label>
    <select class="form-select select2" id="access_namespace">
        <?php
        foreach ($permit as $val) {
            echo "<option value=\"$val\" " . ($val == $data->access_namespace ? "selected" : "") . ">$val</option>";
        }
        ?>
    </select>
</div>
<div class="mb-3">
    <div class="aside-options">
        <div class="clearfix mt-4">
            <div class="form-check form-switch form-switch-lg">
                <input class="form-check-input me-0" id="access_r" type="checkbox" onchange="crud_disabled_all(this.checked)" <?= $data->access_r == 1 ? "checked" : "" ?>>
                <label class="form-check-label fw-semibold small" for="access_r">Read</label>
            </div>
        </div>
        <div><small class="text-medium-emphasis">Allow User with Level of this Privilege to Read / Access Entry</small></div>
    </div>
</div>
<div class="mb-3">
    <div class="aside-options">
        <div class="clearfix mt-4">
            <div class="form-check form-switch form-switch-lg">
                <input class="form-check-input me-0" id="access_c" type="checkbox" <?= $data->access_c == 1 ? "checked" : "" ?>>
                <label class="form-check-label fw-semibold small" for="access_c">Create</label>
            </div>
        </div>
        <div><small class="text-medium-emphasis">Allow User with Level of this Privilege to Create or Insert new Entry</small></div>
    </div>
</div>
<div class="mb-3">
    <div class="aside-options">
        <div class="clearfix mt-4">
            <div class="form-check form-switch form-switch-lg">
                <input class="form-check-input me-0" id="access_u" type="checkbox" <?= $data->access_u == 1 ? "checked" : "" ?>>
                <label class="form-check-label fw-semibold small" for="access_u">Update</label>
            </div>
        </div>
        <div><small class="text-medium-emphasis">Allow User with Level of this Privilege to Update / Change Entry</small></div>
    </div>
</div>
<div class="mb-3">
    <div class="aside-options">
        <div class="clearfix mt-4">
            <div class="form-check form-switch form-switch-lg">
                <input class="form-check-input me-0" id="access_d" type="checkbox" <?= $data->access_d == 1 ? "checked" : "" ?>>
                <label class="form-check-label fw-semibold small" for="access_d">Delete</label>
            </div>
        </div>
        <div><small class="text-medium-emphasis">Allow User with Level of this Privilege to Delete / Remove Entry</small></div>
    </div>
</div>
<script>
    function crud_disabled_all(val) {
        if (val == false) {
            document.getElementById("access_c").checked = false;
            document.getElementById("access_r").checked = false;
            document.getElementById("access_u").checked = false;
            document.getElementById("access_d").checked = false;
        }

    }
</script>