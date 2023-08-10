<div class="card mb-4">
    <div class="card-header"> Privileges Management</a></div>
    <div class="card-body table-responsive">
        <table class="table table-striped border" id="privilist">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Privilege</th>
                    <th>User in Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>
<?php $this->load->view('include/modal', ["size" => "md", "title" => "Privilege", "vertical" => true, "add_btn" => '<button type="button" class="btn btn-primary" onclick="save(this);">Save changes</button>']); ?>
<script>
    let tdatable;

    function edit(btn) {
        $("#gm_title").html("Edit Privilege");
        $.get($(btn).attr("href"), function(data) {
            $('#generalModal').modal('toggle')
            $("#gm_body").html(data);
        });
    }

    function create() {
        $("#gm_title").html("Create Privilege");
        $.get("<?= base_url("privilege/create") ?>", function(data) {
            $('#generalModal').modal('toggle')
            $("#gm_body").html(data);
        });
    }

    function save(btn) {
        const btn_real = btn.innerHTML;
        btn.innerHTML = `<i class="fas fa-spinner-third fa-spin"></i>`;
        if (getval("privilege_id") == "") {
            $.post("<?= base_url("privilege/data/add") ?>", {
                "privilege_name": getval("privilege_name"),
            }, function(data) {
                $('#generalModal').modal('hide')
                $("#gm_body").html("");
                btn.innerHTML = btn_real;
                tdatable.ajax.reload(null, false);
            });
        } else {
            $.post("<?= base_url("privilege/data/edit") ?>", {
                "privilege_id": getval("privilege_id"),
                "privilege_name": getval("privilege_name"),
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
                $.post("<?= base_url("privilege/data/delete") ?>", {
                    "privilege_id": id,
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
        let abno = 1;
        tdatable = $('#privilist').DataTable({
            "initComplete": function(settings, json) {
                $("div.dataTables_filter").append('<button <?= ($permission->c ? "" : "disabled") ?> type="button" class="btn btn-sm ms-1 btn-primary" style="vertical-align: baseline;" onclick="create();" data-coreui-toggle="tooltip" data-coreui-placement="bottom" title="Create new Entry"><i class="fas fa-plus"></i></button>');
                appLoadTooltip();
            },
            ajax: {
                url: '<?= base_url("privilege/data/list") ?>',
                dataSrc: 'data',
            },
            "fnDrawCallback": function() {
                appLoadTooltip();
            },
            columns: [
                {
                    data: 'id',
                    render: function(data, type, row) {
                        return abno++;
                    }
                },
                {
                    data: 'privilege_name',
                    render: dthtmlspecialchars,
                },
                {
                    data: 'account_count'
                },
                {
                    data: 'id',
                    render: function(data, type, row) {
                        return `
                            <button <?= ($permission->u ? "" : "disabled") ?> class="btn text-white btn-sm btn-success me-2" onclick="edit(this)" href="<?= base_url("privilege/edit/") ?>${data}" data-coreui-toggle="tooltip" data-coreui-placement="bottom" title="Edit"><i class="fas fa-pencil-alt"></i></button>
                            <button <?= ($permission->d ? "" : "disabled") ?> ${(row.account_count>0)?`disabled `:``}class="btn text-white btn-sm btn-danger" onclick="remove(${data})" href="#" data-coreui-toggle="tooltip" data-coreui-placement="bottom" title="Delete"><i class="far fa-trash-alt"></i></button>
                            `;
                    }
                },
            ]
        });
    });
</script>