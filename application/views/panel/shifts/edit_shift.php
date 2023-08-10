<input type="hidden" id="shift_id" value="<?= $data->id ?>">


<div class="mb-3">
    <label for="shift_name" class="form-label">Shift Name</label>
    <input type="text" class="form-control" id="shift_name" value="<?= htmlspecialchars($data->shift_name) ?>" placeholder="Enter Shift Name" required>
</div>
<div class="mb-3">
    <label for="shift_start" class="form-label">Shift Start</label>
    <div data-coreui-toggle="time-picker" data-coreui-locale="uk" data-coreui-time="<?= htmlspecialchars($data->shift_start) ?>" id="shift_start"></div>
</div>
<div class="mb-3">
    <label for="shift_end" class="form-label">Shift End</label>
    <div data-coreui-toggle="time-picker" data-coreui-locale="uk" data-coreui-time="<?= htmlspecialchars($data->shift_end) ?>" id="shift_end"></div>
</div>
<div class="mb-3">
    <label for="shift_color" class="form-label">Shift Color</label>
    <input type="color" class="form-control form-control-color"  id="shift_color" value="<?= htmlspecialchars($data->shift_color) ?>" title="Choose Shift color">
</div>