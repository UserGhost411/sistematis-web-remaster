<input type="hidden" id="incident_id" value="<?= $data->id ?>">
<input type="hidden" id="incident_report_id" value="<?= md5(uniqid("a_")) ?>">
<div class="mb-3">
    <label for="incident_log_desc" class="form-label">Incident Information</label>
    <textarea type="text" class="form-control" id="incident_log_desc"  placeholder="Enter Incident Information" required></textarea>
</div>
<div class="mb-3">
    <label for="incident_log_status" class="form-label">Incident Status</label>
    <select class="form-select" id="incident_log_status">
       <option value="0" <?= ($data->incident_status==0?"selected":"") ?>>On Progress</option>
       <option value="1" <?= ($data->incident_status==1?"selected":"") ?>>Done</option>
       <option value="2" <?= ($data->incident_status==2?"selected":"") ?>>Hold</option>
    </select>
</div>