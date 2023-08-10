<div class="card mb-4">
    <div class="card-header"> Incidents</a></div>
    <div class="card-body">
        <table class="table table-striped border" id="companylist">
            <thead>
                <tr>
                    <th>Incident Title</th>
                    <th>Device</th>
                    <th>Status</th>
                    <th>Reporter</th>
                    <th>Reported at</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        <div id="hh"></div>
    </div>
</div>
<?php $this->load->view('include/modal', ["size" => "md", "title" => "Incident", "vertical" => true, "add_btn" => '<button type="button" class="btn btn-primary" onclick="save(this);">Save changes</button>']); ?>
<?php $this->load->view('include/modal', ["id" => "historyModal", "prefix" => "hm", "size" => "xl", "title" => "History Incident", "vertical" => true, "add_btn" => '']); ?>

<script>
    let tdatable;

    function edit(btn) {
        $("#gm_title").html("Edit Incident");
        $.get($(btn).attr("href"), function(data) {
            $('#generalModal').modal('toggle')
            $("#gm_body").html(data);
            appLoadSelect2("#generalModal");
        });
    }

    function create() {
        $("#gm_title").html("Create Incident");
        $.get("<?= base_url("incident/create") ?>", function(data) {
            $('#generalModal').modal('toggle')
            $("#gm_body").html(data);
            appLoadSelect2("#generalModal");
        });
    }

    function report(btn) {
        $("#gm_title").html("Report Incident");
        $.get($(btn).attr("href"), function(data) {
            $('#generalModal').modal('toggle')
            $("#gm_body").html(data);
            appLoadSelect2("#generalModal");
        });
    }

    function history(btn) {
        $("#hm_title").html("History Incident");
        $.get($(btn).attr("href"), function(data) {
            $('#historyModal').modal('toggle')
            $("#hm_body").html(data);
            const aaa = $('#historylist').DataTable({
                ajax: {
                    url: `<?= base_url("incident/data/history") ?>/${$(btn).attr("d-id")}`,
                    dataSrc: 'data',
                },
                order: [
                    [3, 'asc']
                ],
                columns: [{
                        data: 'incident_log_desc',
                        render: dthtmlspecialchars,
                    },
                    {
                        data: 'incident_log_status',
                        render: function(data, type, row) {
                            const a = ["On Progress", "Done", "Hold"];
                            const b = ["info", "success", "warning"]
                            return `<span class="badge bg-${b[data]}-gradient">${a[data]}</span>`;
                        }
                    },
                    {
                        data: 'account_name',
                        render: dthtmlspecialchars,
                    },
                    {
                        data: 'created_at',
                        render: DataTable.render.datetime('DD/MM/YYYY HH:mm:ss'),
                    },
                ]
            });
        });
    }

    function save(btn) {
        const btn_real = btn.innerHTML;
        btn.innerHTML = `<i class="fas fa-spinner-third fa-spin"></i>`;
        if (getval("incident_id") == "") {
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
            });
        } else {
            if (getval("incident_report_id") == "") {
                $.post("<?= base_url("incident/data/edit") ?>", {
                    "incident_id": getval("incident_id"),
                    "incident_name": getval("incident_name"),
                    "incident_status": getval("incident_status"),
                    "incident_device": getval("incident_device"),
                }, function(data) {
                    $('#generalModal').modal('hide')
                    $("#gm_body").html("");
                    btn.innerHTML = btn_real;
                    tdatable.ajax.reload(null, false);

                });
            } else {
                $.post("<?= base_url("incident/data/report") ?>", {
                    "incident_id": getval("incident_id"),
                    "incident_log_status": getval("incident_log_status"),
                    "incident_log_desc": getval("incident_log_desc"),
                }, function(data) {
                    $('#generalModal').modal('hide')
                    $("#gm_body").html("");
                    btn.innerHTML = btn_real;
                    tdatable.ajax.reload(null, false);
                });
            }

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
                $.post("<?= base_url("incident/data/delete") ?>", {
                    "incident_id": id,
                }, function(data) {
                    Swal.fire(
                        'Removed!',
                        'Incident has been deleted from System.',
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
                url: '<?= base_url("incident/data/list") ?>',
                dataSrc: 'data',
            },
            "fnDrawCallback": function() {
                appLoadTooltip();

            },
            order: [[4, 'desc']],
            columns: [{
                    data: 'incident_name',
                    render: dthtmlspecialchars,
                },
                {
                    data: 'device_name',
                    render: function(data, type, row) {
                        return (row.incident_device == 0 ? `Non-Device` : data);
                    }
                },
                {
                    data: 'incident_status',
                    render: function(data, type, row) {
                        const a = ["On Progress", "Done", "Hold"];
                        const b = ["info", "success", "warning"]
                        return `<span class="badge bg-${b[data]}-gradient">${a[data]}</span>`;
                    }
                },
                {
                    data: 'account_name',
                    render: dthtmlspecialchars,
                },
                {
                    data: 'created_at',
                    render: DataTable.render.datetime('DD/MM/YYYY HH:mm:ss'),
                },
                {
                    data: 'id',
                    render: function(data, type, row) {
                        return `
                            <button <?= (($permission->u) ? "" : "disabled") ?> class="btn text-white btn-sm btn-success me-2" onclick="edit(this)" href="<?= base_url("incident/edit/") ?>${data}" data-coreui-toggle="tooltip" data-coreui-placement="bottom" title="Edit"><i class="fas fa-pencil-alt"></i></button>
                            <button <?= (($permission->c) ? "" : "disabled") ?> onclick="report(this)" href="<?= base_url("incident/report/") ?>${data}" class="btn text-white btn-sm btn-info me-2" href="#" data-coreui-toggle="tooltip" data-coreui-placement="bottom" title="Report Incident"><i class="far fa-sticky-note"></i></button>
                            <button class="btn text-white btn-sm btn-info me-2" d-id="${data}" onclick="history(this)" href="<?= base_url("incident/history/") ?>${data}" data-coreui-toggle="tooltip" data-coreui-placement="bottom" title="History"><i class="far fa-history"></i></button>
                            <button <?= ($permission->d ? "" : "disabled") ?> class="btn text-white btn-sm btn-danger" onclick="remove(${data})" href="#" data-coreui-toggle="tooltip" data-coreui-placement="bottom" title="Delete"><i class="far fa-trash-alt"></i></button>`;
                    }
                },
            ]
        });


    });
</script>