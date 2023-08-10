<script>
    document.getElementById("nav_seg3").innerHTML = `<?= date("d M Y", strtotime($date)) ?>`;
</script>
<div class="card mb-4">
    <div class="card-header"> Shift Management</a></div>
    <div class="card-body">
        <div id="calendar"></div>
        <table class="table table-striped border" id="companylist">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Employee</th>
                    <th>Shift Name</th>
                    <th>Shift Start</th>
                    <th>Shift End</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>
<?php $this->load->view('include/modal', ["size" => "md", "title" => "Shift", "vertical" => true, "add_btn" => '<button type="button" class="btn btn-primary" onclick="save(this);">Save changes</button>']); ?>
<script>
    let tdatable;

    function edit(btn) {
        $("#gm_title").html("Edit Shift");
        $.get($(btn).attr("href"), function(data) {
            $('#generalModal').modal('toggle')
            $("#gm_body").html(data);
            appLoadTimerPicker();
            appLoadSelect2("#generalModal");
        });
    }

    function create() {
        $("#gm_title").html("Create Shift");
        $.get("<?= base_url("shift/create") ?>", function(data) {
            $('#generalModal').modal('toggle')
            $("#gm_body").html(data);
            appLoadSelect2("#generalModal");
        });
    }

    function save(btn) {
        const btn_real = btn.innerHTML;
        btn.innerHTML = `<i class="fas fa-spinner-third fa-spin"></i>`;
        if (getval("schedule_id") == "") {
            $.post("<?= base_url("shift/data/add") ?>", {
                "schedule_account": getval("schedule_account"),
                "schedule_shift": getval("schedule_shift"),
                "schedule_date": `<?= $date ?>`,
            }, function(data) {
                $('#generalModal').modal('hide')
                $("#gm_body").html("");
                btn.innerHTML = btn_real;
                tdatable.ajax.reload(null, false);
            });
        } else {
            $.post("<?= base_url("shift/data/edit") ?>", {
                "schedule_id": getval("schedule_id"),
                "schedule_shift": getval("schedule_shift"),
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
                $.post("<?= base_url("shift/data/delete") ?>", {
                    "schedule_id": id,
                }, function(data) {
                    Swal.fire(
                        'Removed!',
                        'Company has been deleted from System.',
                        'success'
                    )
                    tdatable.ajax.reload(null, false);
                });
            }
        })
    }

    function getval(obj) {
        if (document.getElementById(obj) == null) return "";
        if (document.getElementById(obj).value == undefined) return document.getElementById(obj);
        return document.getElementById(obj).value;
    }

    $(document).ready(() => {
        tdatable = $('#companylist').DataTable({
            "initComplete": function(settings, json) {
                $("div.dataTables_filter").append('<button <?= ($permission->c ? "" : "disabled") ?> type="button" class="btn btn-sm ms-1 btn-primary" style="vertical-align: baseline;" onclick="create();" data-coreui-toggle="tooltip" data-coreui-placement="bottom" title="Create new Entry"><i class="fas fa-plus"></i></button>');
                appLoadTooltip();
            },
            ajax: {
                url: '<?= base_url("shift/data/lista") ?>?date=<?= $date ?>',
                dataSrc: 'data',
            },
            "fnDrawCallback": function() {
                appLoadTooltip();
            },
            columns: [{
                    data: 'shift_color',
                    render: function(data, type, row) {
                        return `<span style="height: 16px;width: 16px;background-color: ${data};border-radius: 50%;display: inline-block;"></span>`;
                    }
                },
                {
                    data: 'account_name',
                    render: dthtmlspecialchars,
                },
                {
                    data: 'shift_name',
                    render: dthtmlspecialchars,
                },
                {
                    data: 'shift_start'
                },
                {
                    data: 'shift_end'
                },
                {
                    data: 'id',
                    render: function(data, type, row) {
                        return `
                            <button <?= ($permission->u ? "" : "disabled") ?> class="btn text-white btn-sm btn-success me-2" onclick="edit(this)" href="<?= base_url("shift/edit/") ?>${data}" data-coreui-toggle="tooltip" data-coreui-placement="bottom" title="Edit"><i class="fas fa-pencil-alt"></i></button>
                            <button <?= ($permission->d ? "" : "disabled") ?> class="btn text-white btn-sm btn-danger" onclick="remove(${data})" href="#" data-coreui-toggle="tooltip" data-coreui-placement="bottom" title="Delete"><i class="far fa-trash-alt"></i></button>`;
                    }
                },
            ]
        });
    });
</script>