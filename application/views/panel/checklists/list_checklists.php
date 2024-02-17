<div class="card mb-4">
    <div class="card-header"> Checklist Management</a></div>
    <div class="card-body table-responsive">
        <table class="table table-striped border" id="companylist">
            <thead>
                <tr>
                    <th>Checklist Name</th>
                    <th>Shift</th>
                    <th>Device</th>
                    <th>Repeat</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>
<?php $this->load->view('include/modal', ["size" => "md", "title" => "Checklist", "vertical" => true, "add_btn" => '<button type="button" class="btn btn-primary" onclick="save(this);">Save changes</button>']); ?>
<script>
    let tdatable;

    function edit(btn) {
        $("#gm_title").html("Edit Checklist");
        $.get($(btn).attr("href"), function(data) {
            $('#generalModal').modal('toggle')
            $("#gm_body").html(data);
            appLoadSelect2('#generalModal');
        });
    }

    function create() {
        $("#gm_title").html("Create Checklist");
        $.get("<?= base_url("checklists/create") ?>", function(data) {
            $('#generalModal').modal('toggle')
            $("#gm_body").html(data);
            appLoadSelect2('#generalModal');
        });
    }

    function save(btn) {
        const btn_real = btn.innerHTML;
        btn.innerHTML = `<i class="fas fa-spinner-third fa-spin"></i>`;
        if (getval("checklist_id") == "") {
            $.post("<?= base_url("checklists/data/add") ?>", {
                "checklist_name": getval("checklist_name"),
                "checklist_desc": getval("checklist_desc"),
                "checklist_shift": getval("checklist_shift"),
                "checklist_device": getval("checklist_device"),
                "checklist_repeat": getval("checklist_repeat"),
                "checklist_repeat_info": getval("checklist_repeat_info"),
            }, function(data) {
                $('#generalModal').modal('hide')
                $("#gm_body").html("");
                btn.innerHTML = btn_real;
                tdatable.ajax.reload(null, false);
            });
        } else {
            $.post("<?= base_url("checklists/data/edit") ?>", {
                "checklist_id": getval("checklist_id"),
                "checklist_name": getval("checklist_name"),
                "checklist_desc": getval("checklist_desc"),
                "checklist_shift": getval("checklist_shift"),
                "checklist_device": getval("checklist_device"),
                "checklist_repeat": getval("checklist_repeat"),
                "checklist_repeat_info": getval("checklist_repeat_info"),
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
                $.post("<?= base_url("checklists/data/delete") ?>", {
                    "checklist_id": id,
                }, function(data) {
                    Swal.fire(
                        'Removed!',
                        'Checklist has been deleted from System.',
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
                url: '<?= base_url("checklists/data/list") ?>',
                dataSrc: 'data',
            },
            "fnDrawCallback": function() {
                appLoadTooltip();
            },
            columns: [{
                    data: 'checklist_name',
                    render: dthtmlspecialchars,
                },
                {
                    data: 'shift_color',
                    render: function(data, type, row) {
                        return `<span style="height: 16px;width: 16px;background-color: ${data};border-radius: 50%;display: inline-block;"></span> ${row.shift_name}`;
                    }
                },
                {
                    data: 'device_name',
                    render: dthtmlspecialchars,
                },
                {
                    data: 'checklist_repeat',
                    render: function(data, type, row) {
                        const a = ["daily",  "weekly","montly", "3 month","6 month"];
                        const b = ["success","info",  "primary","warning","danger" ];
                        return `<span class="badge bg-${b[data]}-gradient">${a[data]}</span>`;
                    }
                },
                {
                    data: 'id',
                    render: function(data, type, row) {
                        return `
                            <button <?= ($permission->u ? "" : "disabled") ?> class="btn text-white btn-sm btn-success me-2" onclick="edit(this)" href="<?= base_url("checklists/edit/") ?>${data}" data-coreui-toggle="tooltip" data-coreui-placement="bottom" title="Edit"><i class="fas fa-pencil-alt"></i></button>
                            <a class="btn text-white btn-sm btn-info me-2" href="<?= base_url("checklists/log/") ?>${data}" data-coreui-toggle="tooltip" data-coreui-placement="bottom" title="Show Checklist Data Log"><i class="far fa-calendar-check"></i></a>
                            <button <?= ($permission->d ? "" : "disabled") ?> class="btn text-white btn-sm btn-danger" onclick="remove(${data})" href="#" data-coreui-toggle="tooltip" data-coreui-placement="bottom" title="Delete"><i class="far fa-trash-alt"></i></button>`;
                    }
                },
            ]
        });
    });
</script>