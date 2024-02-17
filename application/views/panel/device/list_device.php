<div class="card mb-4">
    <div class="card-header"> Device Management</a></div>
    <div class="card-body table-responsive">
        <table class="table table-striped border" id="companylist">
            <thead>
                <tr>
                    <th>Device Name</th>
                    <th>Location</th>
                    <th>Owner</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>
<?php $this->load->view('include/modal', ["size" => "md", "title" => "Device", "vertical" => true, "add_btn" => '<button type="button" class="btn btn-primary" onclick="save(this);">Save changes</button>']); ?>
<script>
    let tdatable;

    function edit(btn) {
        $("#gm_title").html("Edit Device");
        $.get($(btn).attr("href"), function(data) {
            $('#generalModal').modal('toggle')
            $("#gm_body").html(data);
            appLoadSelect2();
        });
    }

    function create() {
        $("#gm_title").html("Create Device");
        $.get("<?= base_url("device/create") ?>", function(data) {
            $('#generalModal').modal('toggle')
            $("#gm_body").html(data);
            appLoadSelect2();
        });
    }

    function save(btn) {
        const btn_real = btn.innerHTML;
        btn.innerHTML = `<i class="fas fa-spinner-third fa-spin"></i>`;
        if (getval("device_id") == "") {
            $.post("<?= base_url("device/data/add") ?>", {
                "device_name": getval("device_name"),
                "device_location": getval("device_location"),
                "device_company": getval("device_company"),
                "device_status": getval("device_status"),
            }, function(data) {
                $('#generalModal').modal('hide')
                $("#gm_body").html("");
                btn.innerHTML = btn_real;
                tdatable.ajax.reload(null, false);
            });
        } else {
            $.post("<?= base_url("device/data/edit") ?>", {
                "device_id": getval("device_id"),
                "device_name": getval("device_name"),
                "device_location": getval("device_location"),
                "device_company": getval("device_company"),
                "device_status": getval("device_status"),
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
                $.post("<?= base_url("device/data/delete") ?>", {
                    "device_id": id,
                }, function(data) {
                    Swal.fire(
                        'Removed!',
                        'Device has been deleted from System.',
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
        tdatable = $('#companylist').DataTable({
            "initComplete": function(settings, json) {
                $("div.dataTables_filter").append('<button  <?= ($permission->c ? "" : "disabled") ?> type="button" class="btn btn-sm ms-1 btn-primary" style="vertical-align: baseline;" onclick="create();" data-coreui-toggle="tooltip" data-coreui-placement="bottom" title="Create new Entry"><i class="fas fa-plus"></i></button>');
                appLoadTooltip();
            },
            ajax: {
                url: '<?= base_url("device/data/list") ?>',
                dataSrc: 'data',
            },
            "fnDrawCallback": function() {
                appLoadTooltip();
            },
            columns: [{
                    data: 'device_name',
                    render: dthtmlspecialchars,
                },
                {
                    data: 'device_location',
                    render: dthtmlspecialchars,
                },
                {
                    data: 'company_name',
                    render: dthtmlspecialchars,
                },
                {
                    data: 'device_status',
                    render: function(data, type, row) {
                        const a = ["Problem", "OK"];
                        const b = ["warning", "success"]
                        return `<span class="badge bg-${b[data]}-gradient">${a[data]}</span>`;
                    }
                },
                {
                    data: 'id',
                    render: function(data, type, row) {
                        return `
                            <button <?= ($permission->u ? "" : "disabled") ?> class="btn text-white btn-sm btn-success me-2" onclick="edit(this)" href="<?= base_url("device/edit/") ?>${data}" data-coreui-toggle="tooltip" data-coreui-placement="bottom" title="Edit"><i class="fas fa-pencil-alt"></i></button>
                            <button <?= ($permission->d ? "" : "disabled") ?> class="btn text-white btn-sm btn-danger" onclick="remove(${data})" href="#" data-coreui-toggle="tooltip" data-coreui-placement="bottom" title="Delete"><i class="far fa-trash-alt"></i></button>`;
                    }
                },
            ]
        });
    });
</script>