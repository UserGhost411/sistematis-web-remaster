<link href="<?= base_url("public/css/bootstrap.min.css") ?>" rel="stylesheet">
<style type="text/css" media="print">
    @page {
        size: landscape;
    }
</style>
<div class="row mb-5">
    <div class="col-3"><img height="50px" class="mt-3" src="<?= base_url("public/assets/img/logo_text_dark.png") ?>">
    </div>
    <div class="col-6 text-center">
        <h2><?= $title ?> Maintenance Report</h2>
        <small class="text-muted"><?= date("d/m/Y", $start) ?> - <?= date("d/m/Y", $end) ?></small>
    </div>
    <div class="col-3"><img class="float-right mt-3" height="40px" src="<?= base_url("public/uploads/logo/" . $logo) ?>">
    </div>
</div>
<?php if ((!$progress || count($progress) == 0) && (!$done || count($done) == 0) && (!$hold || count($hold) == 0) && (!$checklist || count($checklist) == 0)) { ?>
    <h4 class="bg-dark px-3 py-2 text-white text-center">No Report Found!</h4>
<?php } ?>
<?php if ($progress && count($progress) > 0) { ?>
    <h4 class="bg-warning px-3 py-2"><b>Progress</b></h4>
    <table style="width:100%" border=0 class="mt-1 mb-4">
        <tr>
            <th>Incident Name</th>
            <th>Device</th>
            <th>Information</th>
            <th>Actors</th>
        </tr>

        <?php foreach ($progress as $val) { ?>
            <tr>
                <td><?= $val->incident_name ?></td>
                <td><?= $val->incident_device ? $val->device_name : "Non-Device" ?></td>
                <td><?= $val->incident_desc ?></td>
                <td><?= $val->incident_by ?></td>
            </tr>
        <?php } ?>

    </table>
<?php } ?>
<?php if ($done && count($done) > 0) { ?>
    <h4 class="bg-success px-3 py-2 text-white"><b>Done</b></h4>
    <table style="width:100%" border=0 class="mt-1 mb-4">
        <tr>
            <th>Incident Name</th>
            <th>Device</th>
            <th>Information</th>
            <th>Actors</th>
        </tr>

        <?php foreach ($done as $val) { ?>
            <tr>
                <td><?= $val->incident_name ?></td>
                <td><?= $val->incident_device ? $val->device_name : "Non-Device" ?></td>
                <td><?= $val->incident_desc ?></td>
                <td><?= $val->incident_by ?></td>
            </tr>
        <?php } ?>

    </table>
<?php } ?>
<?php if ($hold && count($hold) > 0) { ?>
    <h4 class="bg-danger px-3 py-2 text-white"><b>Hold</b></h4>
    <table style="width:100%" border=0 class="mt-1 mb-4">
        <tr>
            <th>Incident Name</th>
            <th>Device</th>
            <th>Information</th>
            <th>Actors</th>
        </tr>

        <?php foreach ($hold as $val) { ?>
            <tr>
                <td><?= $val->incident_name ?></td>
                <td><?= $val->incident_device ? $val->device_name : "Non-Device" ?></td>
                <td><?= $val->incident_desc ?></td>
                <td><?= $val->incident_by ?></td>
            </tr>
        <?php } ?>

    </table>
<?php } ?>
<?php if ($checklist && count($checklist) > 0) { ?>
    <h4 class="bg-info px-3 py-2 text-white"><b>Checklist</b></h4>
    <table style="width:100%" border=0 class="mt-1 mb-4">
        <tr>
            <th>Checklist</th>
            <th>Shift</th>
            <th>Device</th>
            <th>Date</th>
            <th>Reporter</th>
        </tr>

        <?php foreach ($checklist as $val) { ?>
            <tr>
                <td><?= $val->checklist_name ?></td>
                <td><?= $val->shift_name ?></td>
                <td><?= $val->checklist_device ? $val->device_name : "Non-Device" ?></td>
                <td><?= date("d/m/Y H:i:s", strtotime($val->created_at)) ?></td>
                <td><?= $val->account_name ?></td>
            </tr>
        <?php } ?>

    </table>
<?php } ?>

<script>
    window.addEventListener("DOMContentLoaded", (event) => {
        window.print();
        setTimeout(() => {
            //location.reload();
        }, 1000);
    });
</script>