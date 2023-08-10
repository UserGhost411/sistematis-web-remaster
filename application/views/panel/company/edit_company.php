<input type="hidden" id="company_id" value="<?= $data->id ?>">

<div class="mb-3">
    <label for="company_name" class="form-label">Company Name</label>
    <input type="text" class="form-control" id="company_name" value="<?= htmlspecialchars($data->company_name) ?>"  placeholder="Enter Company Name" required>
</div>
<div class="mb-3">
    <label for="company_location" class="form-label">Company Address</label>
    <input type="text" class="form-control" id="company_location" value="<?= htmlspecialchars($data->company_location) ?>" placeholder="Enter Company Address" required> 
</div>
<div class="mb-3">
    <label for="company_info" class="form-label">Company Info</label>
    <textarea type="text" class="form-control" id="company_info"  placeholder="Enter Company Information" required><?= htmlspecialchars($data->company_info) ?></textarea>
</div>
