<div class="card mb-4">
    <div class="card-header"> Checklist Log Management</a></div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-lg-12">
                <div id="myDatePicker" data-coreui-date="<?= date("Y-m-d") ?>" data-coreui-locale="en-UK" data-coreui-toggle="date-picker" data-coreui-input-read-only="true"></div>
            </div>
        </div>
        <table class="table table-striped border" id="companylist">
            <thead>
                <tr>
                    <th>Checklist Name</th>
                    <th>Shift</th>
                    <th>Actor</th>
                    <th>Checklist Status</th>
                    <th>Date</th>
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
    let dateajx = "<?= date("Y-m-d") ?>"
    const myDatePicker = document.getElementById('myDatePicker')
    myDatePicker.addEventListener('dateChange.coreui.date-picker', date => {
        dateajx = `${date.date.getFullYear()}-${((date.date.getMonth()+1).toString().padStart(2, '0'))}-${date.date.getDate().toString().padStart(2, '0')}`
        tdatable.ajax.url(`<?= base_url("checklists/data/log/") ?>${dateajx}`).load();
    })

    function edit(btn) {
        $("#gm_title").html("Edit Checklist");
        $.get($(btn).attr("href"), function(data) {
            $('#generalModal').modal('toggle')
            $("#gm_body").html(data);
            appLoadSelect2();
        });
    }

    function create() {
        $("#gm_title").html("Create Checklist");
        $.get(`<?= base_url("checklists/createlog/") ?>${dateajx}`, function(data) {
            $('#generalModal').modal('toggle')
            $("#gm_body").html(data);
            appLoadSelect2();
            appLoadDatepicker("#created_at");
        });
    }

    function save(btn) {
        const btn_real = btn.innerHTML;
        btn.innerHTML = `<i class="fas fa-spinner-third fa-spin"></i>`;
        if (getval("checklist_data_id") == "") {
            $.post("<?= base_url("checklists/data/addlog") ?>", {
                "checklist_id": getval("checklist_id"),
                "checklist_actor": getval("checklist_actor"),
                "checklist_status": getval("checklist_status"),
                "created_at": `${dateajx}`
            }, function(data) {
                $('#generalModal').modal('hide')
                $("#gm_body").html("");
                btn.innerHTML = btn_real;
                tdatable.ajax.reload(null, false);
            });
        } else {
            $.post("<?= base_url("checklists/data/editlog") ?>", {
                "checklist_data_id": getval("checklist_data_id"),
                "checklist_id": getval("checklist_id"),
                "checklist_actor": getval("checklist_actor"),
                "checklist_status": getval("checklist_status"),
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
                $.post("<?= base_url("checklists/data/deletelog") ?>", {
                    "checklist_data_id": id,
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
                url: `<?= base_url("checklists/data/log/") ?>${dateajx}`,
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
                    data: 'account_name',
                    render: dthtmlspecialchars,

                },
                {
                    data: 'checklist_status',
                    render: function(data, type, row) {
                        const a = ["Error", "Fine"];
                        const b = ["danger", "success"];
                        return `<span class="badge bg-${b[data]}-gradient">${a[data]}</span>`;
                    }
                },
                {
                    data: 'created_at',
                    render: DataTable.render.datetime('DD/MM/YYYY HH:mm:ss'),
                },
                {
                    data: 'id',
                    render: function(data, type, row) {
                        return `
                            <button <?= ($permission->u ? "" : "disabled") ?> class="btn text-white btn-sm btn-success me-2" onclick="edit(this)" href="<?= base_url("checklists/editlog/") ?>${data}" data-coreui-toggle="tooltip" data-coreui-placement="bottom" title="Edit"><i class="fas fa-pencil-alt"></i></button>
                            <button <?= ($permission->d ? "" : "disabled") ?> class="btn text-white btn-sm btn-danger" onclick="remove(${data})" href="#" data-coreui-toggle="tooltip" data-coreui-placement="bottom" title="Delete"><i class="far fa-trash-alt"></i></button>`;
                    }
                },
            ]
        });
    });
</script>