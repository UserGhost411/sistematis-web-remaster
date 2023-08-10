<div class="mb-3">
    <label for="checklist_actor" class="form-label">Account Name</label>
    <select class="form-select select2" id="checklist_actor">
        <?php
        foreach ($account as $val) {
            echo "<option value=\"$val->id\">$val->account_name</option>";
        }
        ?>
    </select>
</div>
<div class="mb-3">
    <label for="checklist_id" class="form-label">Checklist</label>
    <select class="form-select select2" id="checklist_id">
        <?php
        foreach ($checklist as $val) {
            echo "<option value=\"$val->id\">$val->checklist_name</option>";
        }
        ?>
    </select>
</div>
<div class="mb-3">
    <label for="checklist_repeat" class="form-label">Repeat</label>
    <select class="form-select" id="checklist_status">
        <option value="0">Error</option>
        <option value="1">Fine</option>
    </select>
</div>

