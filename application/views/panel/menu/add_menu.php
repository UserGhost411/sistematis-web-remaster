
<input type="hidden" id="menu_privilege" value="<?= $privi->id ?>">
<input type="hidden" id="menu_parent" value="<?= $parent==""?0:$parent ?>">
<div class="mb-3">
    <label for="menu_name" class="form-label">Menu Name</label>
    <input type="text" class="form-control" id="menu_name"  placeholder="Enter Menu Name" required>
</div>
<div class="mb-3">
    <label for="menu_icon" class="form-label">Menu Icon</label>
    <input type="text" class="form-control" id="menu_icon"placeholder="Enter Menu Icon" required> 
</div>
<div class="mb-3">
    <label for="menu_endpoint" class="form-label">Menu Endpoint</label>
    <input type="text" class="form-control" id="menu_endpoint"  placeholder="Enter Menu Endpoint" required>
</div>
<div class="mb-3">
    <label for="menu_position" class="form-label">Menu Position</label>
    <input type="number" class="form-control" id="menu_position"  placeholder="Enter Menu Position" required>
</div>