<script>
    document.getElementById("nav_seg3").innerHTML = `<?= $privi->privilege_name ?>`;
</script>
<div class="card mb-4">
    <div class="card-header"> Access "<?= $privi->privilege_name ?>" Management</a></div>
    <div class="card-body table-responsive">
        <table class="table table-striped border" id="accesslist">
            <thead>
                <tr>
                    <th>Access Permision</th>
                    <th>Create</th>
                    <th>Read</th>
                    <th>Update</th>
                    <th>Delete</th>
                    <th>Last Updated</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>
<?php $this->load->view('include/modal', ["size" => "md", "title" => "Access", "vertical" => true, "add_btn" => '<button type="button" class="btn btn-primary" onclick="save(this);">Save changes</button>']); ?>
<script>
    let tdatable;

    function edit(btn) {
        $("#gm_title").html("Edit Access");
        $.get($(btn).attr("href"), function(data) {
            $('#generalModal').modal('toggle')
            $("#gm_body").html(data);
            appLoadSelect2("#generalModal");
        });
    }

    function create() {
        $("#gm_title").html("Create Access");
        $.get("<?= base_url("access/create/".$privi->id) ?>", function(data) {
            $('#generalModal').modal('toggle')
            $("#gm_body").html(data);
            appLoadSelect2("#generalModal");
        });
    }

    function save(btn) {
        const btn_real = btn.innerHTML;
        btn.innerHTML = `<i class="fas fa-spinner-third fa-spin"></i>`;
        if (getval("access_id") == "") {
            $.post("<?= base_url("access/data/add") ?>", {
                "access_namespace": getval("access_namespace"),
                "access_c": getchk("access_c"),
                "access_r": getchk("access_r"),
                "access_u": getchk("access_u"),
                "access_d": getchk("access_d"),
                "access_privilege": getval("access_privilege"),
            }, function(data) {
                $('#generalModal').modal('hide')
                $("#gm_body").html("");
                btn.innerHTML = btn_real;
                tdatable.ajax.reload(null, false);
            });
        } else {
            $.post("<?= base_url("access/data/edit") ?>", {
                "access_id": getval("access_id"),
                "access_namespace": getval("access_namespace"),
                "access_c": getchk("access_c"),
                "access_r": getchk("access_r"),
                "access_u": getchk("access_u"),
                "access_d": getchk("access_d"),
                "access_privilege": getval("access_privilege"),
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
                $.post("<?= base_url("access/data/delete") ?>", {
                    "access_id": id,
                }, function(data) {
                    Swal.fire(
                        'Removed!',
                        'Access has been deleted from System.',
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
    function getchk(obj) {
        if (document.getElementById(obj) == null) return "";
        return document.getElementById(obj).checked?1:0;
    }

    $(document).ready(() => {
        tdatable = $('#accesslist').DataTable({
            "initComplete": function(settings, json) {
                $("div.dataTables_filter").append('<button <?= ($permission->c ? "" : "disabled") ?> type="button" class="btn btn-sm ms-1 btn-primary" style="vertical-align: baseline;" onclick="create();" data-coreui-toggle="tooltip" data-coreui-placement="bottom" title="Create new Entry"><i class="fas fa-plus"></i></button>');
                appLoadTooltip();
            },
            ajax: {
                url: '<?= base_url("access/data/lista/".$privi->id) ?>',
                dataSrc: 'data',
            },
            "fnDrawCallback": function() {
                appLoadTooltip();
            },
            columns: [{
                    data: 'access_namespace',
                    render: dthtmlspecialchars,
                },
                {
                    data: 'access_c',
                    render: function(data, type, row) {
                        let status = ["No", "Yes"];
                        let bss = ["danger", "success"];
                        return `<span class="badge bg-${bss[data]}-gradient">${status[data]}</span>`;
                    }
                },
                {
                    data: 'access_r',
                    render: function(data, type, row) {
                        let status = ["No", "Yes"];
                        let bss = ["danger", "success"];
                        return `<span class="badge bg-${bss[data]}-gradient">${status[data]}</span>`;
                    }
                },
                {
                    data: 'access_u',
                    render: function(data, type, row) {
                        let status = ["No", "Yes"];
                        let bss = ["danger", "success"];
                        return `<span class="badge bg-${bss[data]}-gradient">${status[data]}</span>`;
                    }
                },
                {
                    data: 'access_d',
                    render: function(data, type, row) {
                        let status = ["No", "Yes"];
                        let bss = ["danger", "success"];
                        return `<span class="badge bg-${bss[data]}-gradient">${status[data]}</span>`;
                    }
                },
                {
                    data: 'updated_at'
                },
                {
                    data: 'id',
                    render: function(data, type, row) {
                        return `
                            <button <?= ($permission->u ? "" : "disabled") ?> class="btn text-white btn-sm btn-success me-2" onclick="edit(this)" href="<?= base_url("access/edit/") ?>${data}" data-coreui-toggle="tooltip" data-coreui-placement="bottom" title="Edit"><i class="fas fa-pencil-alt"></i></button>
                            <button <?= ($permission->d ? "" : "disabled") ?> class="btn text-white btn-sm btn-danger" onclick="remove(${data})" href="#" data-coreui-toggle="tooltip" data-coreui-placement="bottom" title="Delete"><i class="far fa-trash-alt"></i></button>`;
                    }
                },
            ]
        });
    });
</script>