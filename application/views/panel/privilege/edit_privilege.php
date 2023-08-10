<input type="hidden" id="privilege_id" value="<?= $data->id ?>">

<div class="mb-3">
    <label for="privilege_name" class="form-label">Privilege Name</label>
    <input type="text" class="form-control" id="privilege_name" value="<?= htmlspecialchars($data->privilege_name) ?>"  placeholder="Enter Privilege Name" required>
</div>


