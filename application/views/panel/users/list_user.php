<div class="card mb-4">
    <div class="card-header"> Users Management</a></div>
    <div class="card-body table-responsive">
        <table class="table table-striped border" id="userlist">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Company</th>
                    <th>Division</th>
                    <th>Role</th>
                    <th>Created</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>
<?php $this->load->view('include/modal', ["size" => "md", "title" => "User", "vertical" => true, "add_btn" => '<button type="button" class="btn btn-primary" onclick="save(this);">Save changes</button>']); ?>
<?php $this->load->view('include/modal', ["id" => "passModal", "prefix" => "pm", "size" => "md", "title" => "Change User Password", "vertical" => true, "add_btn" => '<button type="button" class="btn btn-primary" onclick="chgpass(this);">Save changes</button>']); ?>

<script>
    let tdatable;

    function edit(btn) {
        $("#gm_title").html("Edit User");
        $.get($(btn).attr("href"), function(data) {
            $('#generalModal').modal('toggle')
            $("#gm_body").html(data);
            appLoadSelect2("#generalModal");
        });
    }

    function editpass(btn) {
        $.get($(btn).attr("href"), function(data) {
            $('#passModal').modal('toggle')
            $("#pm_body").html(data);
        });
    }

    function reloadDivision(val) {
        $.get(`<?= base_url("users/data/division/") ?>${val}`, function(data) {
            if (data.status == 200) {
                document.getElementById("account_division").innerHTML = "";
                let divisionall = [];
                for (const it of data.data) {
                    divisionall.push({
                        "id": it.id,
                        "text": it.division_name
                    })
                }
                $("#account_division").select2({
                    data: divisionall,
                    theme: 'bootstrap4',
                    dropdownParent: $(`#generalModal .modal-content`),
                })
            }
        });
    }

    function chgpass(btn) {
        const btn_real = btn.innerHTML;
        if (getval("password1") != getval("password2")) {
            Swal.fire(
                'Password Mismatch!',
                'Please Check your Input!.',
                'error'
            )
            return;
        }
        btn.innerHTML = `<i class="fas fa-spinner-third fa-spin"></i>`;
        $.post("<?= base_url("users/data/pass") ?>", {
            "account_id": getval("account_id"),
            "password": getval("password1"),
        }, function(data) {
            $('#passModal').modal('hide')
            $("#pm_body").html("");
            btn.innerHTML = btn_real;
            Swal.fire(
                'Password Changed!',
                'User Password Changed Successfuly',
                'success'
            )
        });
    }

    function create() {
        $("#gm_title").html("Create User");
        $.get("<?= base_url("users/create") ?>", function(data) {
            $('#generalModal').modal('toggle')
            $("#gm_body").html(data);
            appLoadSelect2("#generalModal");
        });
    }

    function save(btn) {
        const btn_real = btn.innerHTML;
        btn.innerHTML = `<i class="fas fa-spinner-third fa-spin"></i>`;
        if (getval("account_id") == "") {
            $.post("<?= base_url("users/data/add") ?>", {
                "account_username": getval("account_username"),
                "account_email": getval("account_email"),
                "account_name": getval("account_name"),
                "account_telp": getval("account_telp"),
                "account_company": getval("account_company"),
                "account_division": getval("account_division"),
                "account_level": getval("account_level"),
                "account_status": getval("account_status"),
                "account_password": getval("account_password"),
            }, function(data) {
                $('#generalModal').modal('hide')
                $("#gm_body").html("");
                btn.innerHTML = btn_real;
                tdatable.ajax.reload(null, false);
            });
        } else {
            $.post("<?= base_url("users/data/edit") ?>", {
                "account_id": getval("account_id"),
                "account_username": getval("account_username"),
                "account_email": getval("account_email"),
                "account_name": getval("account_name"),
                "account_telp": getval("account_telp"),
                "account_company": getval("account_company"),
                "account_division": getval("account_division"),
                "account_level": getval("account_level"),
                "account_status": getval("account_status"),
            }, function(data) {
                $('#generalModal').modal('hide')
                $("#gm_body").html("");
                btn.innerHTML = btn_real;
                tdatable.ajax.reload(null, false);

            });
        }


    }

    function remove(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.post("<?= base_url("users/data/delete") ?>", {
                    "account_id": id,
                }, function(data) {
                    Swal.fire(
                        'Removed!',
                        'User has been deleted from System.',
                        'success'
                    )
                    tdatable.ajax.reload(null, false);
                });
            }
        })
    }

    function getval(obj) {
        if (document.getElementById(obj) == null) return "";
        return document.getElementById(obj).value;
    }

    $(document).ready(() => {
        tdatable = $('#userlist').DataTable({
            "initComplete": function(settings, json) {
                $("div.dataTables_filter").append('<button <?= ($permission->c ? "" : "disabled") ?> type="button" class="btn btn-sm ms-1 btn-primary" style="vertical-align: baseline;" onclick="create();" data-coreui-toggle="tooltip" data-coreui-placement="bottom" title="Create new Entry"><i class="fas fa-plus"></i></button>');
                appLoadTooltip();
            },
            ajax: {
                url: '<?= base_url("users/data/list") ?>',
                dataSrc: 'data',
            },
            "fnDrawCallback": function() {
                appLoadTooltip();
            },
            columns: [{
                    data: 'account_username',
                    render: dthtmlspecialchars,
                },
                {
                    data: 'account_name',
                    render: dthtmlspecialchars,
                },
                {
                    data: 'account_email',
                    render: dthtmlspecialchars,
                },
                {
                    data: 'company_name',
                    render: dthtmlspecialchars,
                },
                {
                    data: 'division_name',
                    render: dthtmlspecialchars,
                },
                {
                    data: 'privilege_name',
                    render: dthtmlspecialchars,
                },
                {
                    data: 'created_at',
                    render: DataTable.render.datetime('DD/MM/YYYY HH:mm:ss'),
                },
                {
                    data: 'account_status',
                    render: function(data, type, row) {
                        let status = ["Deactivated", "Active"];
                        let bss = ["danger", "success"];
                        return `<span class="badge bg-${bss[data]}-gradient">${status[data]}</span>`;
                    }
                },
                {
                    data: 'id',
                    render: function(data, type, row) {
                        return `
                            <button <?= ($permission->u ? "" : "disabled") ?> class="btn text-white btn-sm btn-success me-2" onclick="edit(this)" href="<?= base_url("users/edit/") ?>${data}" data-coreui-toggle="tooltip" data-coreui-placement="bottom" title="Edit"><i class="fas fa-pencil-alt"></i></button>
                            <button <?= ($permission->u ? "" : "disabled") ?> class="btn text-white btn-sm btn-info me-2" onclick="editpass(this)" href="<?= base_url("users/pass/") ?>${data}" data-coreui-toggle="tooltip" data-coreui-placement="bottom" title="Change Password"><i class="far fa-key"></i></button>
                            <button <?= ($permission->d ? "" : "disabled") ?> class="btn text-white btn-sm btn-danger" onclick="remove(${data})" href="#" data-coreui-toggle="tooltip" data-coreui-placement="bottom" title="Delete"><i class="far fa-trash-alt"></i></button>`;
                    }
                },
            ]
        });
    });
</script>