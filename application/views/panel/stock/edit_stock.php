
<input type="hidden" id="stock_id" value="<?= $data->id ?>">
<div class="mb-3">
    <label for="stock_type" class="form-label">Stock Type</label>
    <select class="form-select select2" id="stock_type">
        <?php
        foreach ($stock_type as $val) {
            echo "<option value=\"$val->id\" ".($val->id==$data->stock_type?"selected":"").">$val->stock_type_name</option>";
        }
        ?>
    </select>
</div>
<div class="mb-3">
    <label for="stock_name" class="form-label">Stock Name</label>
    <input type="text" class="form-control" id="stock_name" value="<?= htmlspecialchars($data->stock_name) ?>" placeholder="Enter Stock Name" required>
</div>
<div class="mb-3">
    <label for="stock_location" class="form-label">Stock Location</label>
    <input type="text" class="form-control" id="stock_location" value="<?= htmlspecialchars($data->stock_location) ?>"  placeholder="Enter Stock Location" required>
</div>
<div class="mb-3">
    <label for="stock_desc" class="form-label">Stock Information</label>
    <textarea type="text" class="form-control" id="stock_desc" placeholder="Enter Stock Information" required><?= $data->stock_desc ?></textarea>
</div>
