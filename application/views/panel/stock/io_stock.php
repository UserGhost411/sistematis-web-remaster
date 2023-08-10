
<input type="hidden" id="stock_id" value="<?= $data->id ?>">
<div class="mb-3">
    <label for="stock_name" class="form-label">Stock Name</label>
    <input type="text" class="form-control" id="stock_name" value="<?= $data->stock_name ?>" placeholder="Enter Stock Name" readonly>
</div>
<div class="mb-3">
    <label for="stock_status" class="form-label">Stock Exchange State</label>
    <select class="form-select" id="stock_status">
    <option value="1">Enter / In</option>
    <option value="0">Leave / Out</option>
    </select>
</div>
<div class="mb-3">
    <label for="stock_total" class="form-label">Total Stock Exchange</label>
    <input type="number" class="form-control" id="stock_total"  placeholder="Enter Total Stock Exchange"  value="0" required>
</div>
<div class="mb-3">
    <label for="stock_reason" class="form-label">Exchange Reason</label>
    <textarea type="text" class="form-control" id="stock_reason" placeholder="Enter Exchange Stock Reason" required></textarea>
</div>
