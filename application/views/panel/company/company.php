<div class="row">
    <div class="col-9">
        <div class="card mb-4">
            <div class="card-header"> Company Profile</a></div>
            <div class="card-body">
                <?php if ($this->session->has_userdata("msg")) { ?>
                    <div class="alert alert-success alert-dismissible fade show">
                        <button type="button" class="btn-close" data-coreui-dismiss="alert"></button>
                        <?= $this->session->userdata("msg") ?>
                    </div>
                <?php } ?>
                <form method="POST">
                    <input type="hidden" id="company_id" value="<?= $data->id ?>">
                    <div class="mb-3">
                        <label for="company_name" class="form-label">Company Name</label>
                        <input type="text" class="form-control" name="company_name" value="<?= htmlspecialchars($data->company_name) ?>" placeholder="Enter Company Name" required>
                    </div>
                    <div class="mb-3">
                        <label for="company_location" class="form-label">Company Address</label>
                        <input type="text" class="form-control" name="company_location" value="<?= htmlspecialchars($data->company_location) ?>" placeholder="Enter Company Address" required>
                    </div>
                    <div class="mb-3">
                        <label for="company_info" class="form-label">Company Info</label>
                        <textarea type="text" class="form-control" name="company_info" placeholder="Enter Company Information" required><?= htmlspecialchars($data->company_info) ?></textarea>
                    </div>
                    <button class="btn btn-success px-3 text-white"><i class="far fa-save"></i> Save</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="card mb-4">
            <div class="card-body text-center">

                <img width="80%" id="mypp" src="<?= base_url("public/uploads/logo/" . $data->company_logo) ?>" alt="<?= htmlspecialchars($data->company_name) ?>">
                <br>
                <button class="btn btn-outline-success mt-3" onclick="sel_upload(this)" data-coreui-toggle="tooltip" data-coreui-placement="bottom" title="Max Size: 1mb | Max Dimens: 1024x1024">Change Logo</button>
            </div>
        </div>
    </div>
</div>
<script>
    function sel_upload(btn) {

        var input = document.createElement('input');
        input.type = 'file';
        input.accept = '.jpg,.jpeg,.png';
        input.onchange = e => {

            var file = e.target.files[0];
            var formData = new FormData();
            formData.append("image", file);
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function(e) {
                if (this.readyState == 4 && this.status == 200) {
                    btn.innerHTML = "Change Logo"
                    var dat = JSON.parse(this.responseText);
                    if (dat.status == 200) {
                        document.getElementById('mypp').src = `<?= base_url("public/uploads/logo/") ?>${dat.logo}`;

                    } else {
                        Swal.fire(
                            'Failed to Change Logo!',
                            dat.message,
                            'error'
                        )
                    }

                }
            };
            xhr.open('POST', "<?= base_url("company/logo_upload") ?>", true);
            btn.innerHTML = `<i class="fas fa-spinner-third fa-spin"></i>`
            xhr.send(formData);
        }
        input.click();
    }
</script>