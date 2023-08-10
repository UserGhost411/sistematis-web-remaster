<?php if (isset($external)) { ?>
    <html>
    <head>
        <title>Add Incident</title>
        <link href="<?= base_url("public/css/style.css") ?>" rel="stylesheet">
        <link href="<?= base_url("public/vendors/datatables.net-bs4/css/dataTables.bootstrap4.css") ?>" rel="stylesheet">
        <link href="<?= base_url("public/vendors/sweetalert2/sweetalert2.min.css") ?>" rel="stylesheet" title="lightswal" <?= (isset($_COOKIE["display_theme"]) && $_COOKIE["display_theme"] == "dark") ? "disabled" : "" ?>>
        <link href="<?= base_url("public/vendors/sweetalert2/sweetalert2-dark.min.css") ?>" rel="stylesheet" title="darkswal" <?= (isset($_COOKIE["display_theme"]) && $_COOKIE["display_theme"] == "dark") ? "" : "disabled" ?>>
        <link href="<?= base_url("public/vendors/fullcalendar/css/main.css") ?>" rel="stylesheet">
        <link href="<?= base_url("public/vendors/select2/css/select2.min.css") ?>" rel="stylesheet">
        <link href="<?= base_url("public/vendors/select2/css/select2-bs.min.css") ?>" rel="stylesheet" aa="lightselect" <?= (isset($_COOKIE["display_theme"]) && $_COOKIE["display_theme"] == "dark") ? "disabled" : "" ?>>
        <link href="<?= base_url("public/vendors/select2/css/select2-bs-dark.min.css") ?>" rel="stylesheet" aa="darkselect" <?= (isset($_COOKIE["display_theme"]) && $_COOKIE["display_theme"] == "dark") ? "" : "disabled" ?>>
        <script src="<?= base_url("public/vendors/jquery/js/jquery.min.js") ?>"></script>
        <script src="<?= base_url("public/vendors/moment/moment.js") ?>"></script>
        <script src="<?= base_url("public/vendors/simplebar/js/simplebar.min.js") ?>"></script>
        <script src="<?= base_url("public/vendors/sweetalert2/sweetalert2.all.min.js") ?>"></script>
        <script src="<?= base_url("public/vendors/select2/js/select2.full.min.js") ?>"></script>

    </head>

    <body>
        <form method="POST">
        <div class="container-lg mt-2">
        <?php } ?>
        <div class="mb-3">
            <label for="incident_name" class="form-label">Incident Name</label>
            <input type="text" class="form-control" id="incident_name" placeholder="Enter Incident Name" value="<?= $checklist!=null?"Failure Check at Checklist#$checklist->id ($checklist->checklist_name)":"" ?>" required>
            <?= ($checklist!=null?"<input type='hidden' name='checklist_id' value='$checklist->id'>":"") ?>
        </div>
        <div class="mb-3">
            <label for="incident_device" class="form-label">Incident Device</label>
            <select class="form-select select2" id="incident_device">
                <option value="0">Non-Device</option>
                <?php
                foreach ($devices as $val) {
                    echo "<option value=\"$val->id\" " . ($val->id == $device_selc ? "selected" : "") . ">$val->device_name</option>";
                }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="incident_log_desc" class="form-label">Incident Information</label>
            <textarea type="text" class="form-control" id="incident_log_desc" placeholder="Enter Incident Information" required></textarea>
        </div>
        <div class="mb-3">
            <label for="incident_status" class="form-label">Incident Status</label>
            <select class="form-select" id="incident_status">
                <option value="0">On Progress</option>
                <option value="1">Done</option>
                <option value="2">Hold</option>
            </select>
        </div>
        <?php if (isset($external)) { ?>
            <button type="submit" class="btn btn-primary">Add Incident</button>
        </div>
        </form>
        <script>
            $('.select2').select2({
                theme: 'bootstrap4',
            });
            alert("Test")
        </script>
    </body>

    </html>
<?php } ?>