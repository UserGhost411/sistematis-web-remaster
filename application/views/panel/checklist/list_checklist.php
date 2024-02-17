<div class="card mb-4">
    <div class="card-header"> Checklist</a></div>
    <div class="card-body table-responsive">
        <table class="table table-striped border" id="companylist">
            <thead>
                <tr>
                    <th>Checklist Name</th>
                    <th>Instruktion</th>
                    <th>Device</th>
                    <th>Shift</th>
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

    function edit(btn, val) {
        btn.innerHTML = `<i class="fas fa-spinner-third fa-spin"></i>`;
        $.post($(btn).attr("href"), {
            "checklist_id": (($(btn).attr("dc-id") == "0") ? $(btn).attr("d-id") : $(btn).attr("dc-id")),
            "checklist_status": val,
        }, function(data) {
            //$('#generalModal').modal('hide')
            //$("#gm_body").html("");
            //btn.innerHTML = btn_real;
            tdatable.ajax.reload(null, false);
            if (val == 0) {
                $("#gm_title").html("Create Incident");
                $.get(`<?= base_url("incident/create/") ?>${$(btn).attr("d-device")}`, function(data) {
                    $('#generalModal').modal('toggle')
                    $("#gm_body").html(data);
                    document.getElementById("incident_name").value = `Failure Check at Checklist#${$(btn).attr("d-id")} (${$(btn).attr("d-title")})`
                    appLoadSelect2();
                });
            }
        });



    }

    function create() {
        $("#gm_title").html("Create Checklist");
        $.get("<?= base_url("checklist/create") ?>", function(data) {
            $('#generalModal').modal('toggle')
            $("#gm_body").html(data);
            appLoadSelect2();
        });
    }

    function save(btn) {
        const btn_real = btn.innerHTML;
        btn.innerHTML = `<i class="fas fa-spinner-third fa-spin"></i>`;
        $.post("<?= base_url("incident/data/add") ?>", {
            "incident_name": getval("incident_name"),
            "incident_status": getval("incident_status"),
            "incident_device": getval("incident_device"),
            "incident_log_desc": getval("incident_log_desc"),
        }, function(data) {
            $('#generalModal').modal('hide')
            $("#gm_body").html("");
            btn.innerHTML = btn_real;
            tdatable.ajax.reload(null, false);
            Swal.fire(
                'Removed!',
                'Incident has been reported.',
                'success'
            )
        });

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
                $.post("<?= base_url("checklist/data/delete") ?>", {
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
                appLoadTooltip();
            },
            ajax: {
                url: '<?= base_url("checklist/data/list") ?>',
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
                    data: 'checklist_desc',
                    render: dthtmlspecialchars,
                },
                {
                    data: 'device_name',
                    render: function(data, type, row) {
                        return `${data=="" || data==null?"Non-Device":data}`;
                    }
                },
                {
                    data: 'shift_color',
                    render: function(data, type, row) {
                        return `<span style="height: 16px;width: 16px;background-color: ${data};border-radius: 50%;display: inline-block;"></span> ${row.shift_name}`;
                    }
                },
                {
                    data: 'id',
                    render: function(data, type, row) {
                        return `
                            <button <?= ($permission->c ? "" : "disabled") ?> ${row.has_check && row.data_value==1?"disabled":""} class="btn text-white btn-sm btn-${row.has_check && row.data_value==1?"primary":"success"} me-2" d-id="${row.id}" dc-id="${row.data_id}" d-device="${row.checklist_device}" d-title="${row.checklist_name}" onclick="edit(this,1)" href="<?= base_url("checklist/data/") ?>${row.has_check?"edit":"submit"}" data-coreui-toggle="tooltip" data-coreui-placement="bottom" title="Done"><i class="far fa-check"></i></button>
                            <button <?= ($permission->c ? "" : "disabled") ?> ${row.has_check && row.data_value==0?"disabled":""} class="btn text-white btn-sm btn-${row.has_check && row.data_value==0?"primary":"danger"} me-2" d-id="${row.id}" dc-id="${row.data_id}" d-device="${row.checklist_device}" d-title="${row.checklist_name}" onclick="edit(this,0)" href="<?= base_url("checklist/data/") ?>${row.has_check?"edit":"submit"}" data-coreui-toggle="tooltip" data-coreui-placement="bottom" title="Error"><i class="far fa-times"></i></button>
                            `;
                    }
                },
            ]
        });
    });
</script>