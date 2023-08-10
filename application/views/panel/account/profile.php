<div class="row">
    <div class="col-2"></div>
    <div class="col-8">
        <div class="card mb-4">
            <div class="card-header"> My Profile</a></div>
            <div class="card-body">
                <?php if ($this->session->has_userdata("msg")) { ?>
                    <div class="alert alert-success alert-dismissible fade show">
                        <button type="button" class="btn-close" data-coreui-dismiss="alert"></button>
                        <?= $this->session->userdata("msg") ?>
                    </div>
                <?php } ?>
                <form method="POST">
                    <div class="mb-3">

                        <label class="form-label">Username</label>
                        <input type="text" value="<?= $this->userdata->account_username ?>" class="form-control" readonly>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-6">
                                <label class="form-label">Company</label>
                                <input type="text" value="<?= $this->userdata->company_name ?>" class="form-control" readonly>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Division</label>
                                <input type="text" value="<?= $this->userdata->division_name ?>" class="form-control" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="account_name" class="form-label">Name</label>
                        <input type="text" value="<?= htmlspecialchars($this->userdata->account_name) ?>" class="form-control" name="account_name" id="account_name" placeholder="Enter Account Name" required>
                    </div>
                    <div class="mb-3">
                        <label for="account_email" class="form-label">Email</label>
                        <input type="email" value="<?= htmlspecialchars($this->userdata->account_email) ?>" class="form-control" name="account_email" id="account_email" placeholder="Enter Account Email" required>
                    </div>

                    <div class="mb-3">
                        <label for="account_telp" class="form-label">Telp Number</label>
                        <input type="number" value="<?= htmlspecialchars($this->userdata->account_telp) ?>" class="form-control" name="account_telp" id="account_telp" placeholder="enter Account Telp Number" required>
                    </div>
                    <button class="btn mt-1 btn-success text-white" type="submit"><i class="far fa-save"></i> Save Profile</button>
                    <button href="<?= base_url("account/password") ?>" onclick="chgpass(this)" class="btn mt-1 btn-danger text-white" type="button"><i class="far fa-unlock-alt"></i> Change Password</button>
                </form>

            </div>
        </div>
    </div>

</div>
<?php $this->load->view('include/modal', ["size" => "md", "title" => "Device", "vertical" => true, "add_btn" => '<button type="button" class="btn btn-primary" onclick="save(this);">Save changes</button>']); ?>
<script>
    let tdatable;

    function chgpass(btn) {
        $("#gm_title").html("Change Password");
        $.get($(btn).attr("href"), function(data) {
            $('#generalModal').modal('toggle')
            $("#gm_body").html(data);
        });
    }

    function save(btn) {
        const btn_real = btn.innerHTML;
        btn.innerHTML = `<i class="fas fa-spinner-third fa-spin"></i>`;
        if (getval("password1") == getval("password2")) {
            $.post("<?= base_url("account/data/changepass") ?>", {
                "password": getval("password1"),
            }, function(data) {
                Swal.fire(
                    'Password Changed!',
                    'Your Password Changed Successfuly',
                    'success'
                )
                $('#generalModal').modal('hide')
                $("#gm_body").html("");
                btn.innerHTML = btn_real;
            });
        } else {
            btn.innerHTML = btn_real;
            Swal.fire(
                'Password Mismatch!',
                'Please Check your Password!.',
                'error'
            )
        }

    }

    function getval(obj) {
        if (document.getElementById(obj) == null) return "";
        return document.getElementById(obj).value;
    }
</script>