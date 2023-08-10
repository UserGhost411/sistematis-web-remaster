<input type="hidden" id="stock_type_id" value="<?= $data->id ?>">

<div class="mb-3">
    <label for="stock_type_name" class="form-label">Stock Type Name</label>
    <input type="text" class="form-control" id="stock_type_name" value="<?= htmlspecialchars($data->stock_type_name) ?>"  placeholder="Enter Stock Type Name" required>
</div>


