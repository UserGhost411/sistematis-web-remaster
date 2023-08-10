<div class="mb-3">
    <label for="division_name" class="form-label">Division Name</label>
    <input type="text" class="form-control" id="division_name" placeholder="Enter Division Name" required>
</div>
<div class="mb-3">
    <label for="division_company" class="form-label">Division Company</label>
    <select class="form-select select2" id="division_company">
        <?php
        foreach ($company as $val) {
            echo "<option value=\"$val->id\" " . ($data->division_company == $val->id ? "selected" : "") . ">$val->company_name </option>";
        }
        ?>
    </select>
</div>
