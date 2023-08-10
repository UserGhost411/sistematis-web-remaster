<input type="hidden" id="account_id" value="<?= $userdata->id ?>">
<div class="mb-3">
    <label for="account_username" class="form-label">Username</label>
    <input type="text" class="form-control" id="account_username" value="<?= htmlspecialchars($userdata->account_username) ?>" placeholder="Enter Account Username" required>
</div>
<div class="mb-3">
    <label for="account_email" class="form-label">Email</label>
    <input type="email" class="form-control" id="account_email" value="<?= htmlspecialchars($userdata->account_email) ?>" placeholder="Enter Account Email" required> 
</div>
<div class="mb-3">
    <label for="account_name" class="form-label">Real Name</label>
    <input type="text" class="form-control" id="account_name" value="<?= htmlspecialchars($userdata->account_name) ?>" placeholder="Enter Account Name" required>
</div>
<div class="mb-3">
    <label for="account_telp" class="form-label">Telp Number</label>
    <input type="number" class="form-control" id="account_telp" value="<?= htmlspecialchars($userdata->account_telp) ?>" placeholder="enter Account Telp Number">
</div>
<div class="mb-3">
    <label for="account_company" class="form-label">Company</label>
    <select class="form-select select2" id="account_company" onchange="reloadDivision(this.value)">
        <?php 
            foreach($company as $val){
                echo "<option value=\"".$val->id."\" ".($val->id==$userdata->account_company?"selected":"").">".$val->company_name."</option>";
            }
        ?>
    </select>
</div>
<div class="mb-3">
    <label for="account_division" class="form-label">Division</label>
    <select class="form-select select2" id="account_division">
        <?php 
            foreach($division as $val){
                echo "<option value=\"".$val->id."\">".$val->division_name."</option>";
            }
        ?>
    </select>
</div>
<div class="mb-3">
    <label for="account_level" class="form-label">Role</label>
    <select class="form-select" id="account_level">
        <?php 
            foreach($level as $val){
                echo "<option value=\"".$val->id."\" ".($val->id==$userdata->account_level?"selected":"").">".$val->privilege_name."</option>";
            }
        ?>
    </select>
</div>
<div class="mb-3">
    <label for="account_status" class="form-label">Status</label>
    <select class="form-select" id="account_status">
        <option value="0" <?= $userdata->account_status==0?"selected":"" ?>>Non-Active</option>
        <option value="1" <?= $userdata->account_status==1?"selected":"" ?>>Active</option>
    </select>
</div>
