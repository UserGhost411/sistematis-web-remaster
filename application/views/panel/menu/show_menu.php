<script>
    document.getElementById("nav_seg3").innerHTML = `<?= $privi->privilege_name ?>`;
    <?php if (isset($sub) && $sub) { ?>
        document.getElementById("nav_seg4").innerHTML = `<?= $sub->menu_name ?>`;
    <?php } ?>
</script>
<div class="card mb-4">
    <div class="card-header"> Menu Management</a></div>
    <div class="card-body table-responsive">
        <table class="table table-striped border" id="companylist">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Menu</th>
                    <th>Menu Order</th>
                    <th>Updated</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>
<?php $this->load->view('include/modal', ["size" => "md", "title" => "Menu", "vertical" => true, "add_btn" => '<button type="button" class="btn btn-primary" onclick="save(this);">Save changes</button>']); ?>
<script>
    let tdatable;

    function edit(btn) {
        $("#gm_title").html("Edit Menu");
        $.get($(btn).attr("href"), function(data) {
            $('#generalModal').modal('toggle')
            $("#gm_body").html(data);
        });
    }

    function create() {
        $("#gm_title").html("Create Menu");
        $.get("<?= base_url("menus/create/" . $privi->id) ?><?= (isset($sub) && $sub)?"/$sub->id":"" ?>", function(data) {
            $('#generalModal').modal('toggle')
            $("#gm_body").html(data);
        });
    }

    function save(btn) {
        const btn_real = btn.innerHTML;
        btn.innerHTML = `<i class="fas fa-spinner-third fa-spin"></i>`;
        if (getval("menu_id") == "") {
            $.post("<?= base_url("menus/data/add") ?>", {
                "menu_name": getval("menu_name"),
                "menu_icon": getval("menu_icon"),
                "menu_endpoint": getval("menu_endpoint"),
                "menu_position": getval("menu_position"),
                "menu_parent": getval("menu_parent"),
                "menu_privilege": getval("menu_privilege"),
            }, function(data) {
                $('#generalModal').modal('hide')
                $("#gm_body").html("");
                btn.innerHTML = btn_real;
                tdatable.ajax.reload(null, false);
            });
        } else {
            $.post("<?= base_url("menus/data/edit") ?>", {
                "menu_id": getval("menu_id"),
                "menu_name": getval("menu_name"),
                "menu_icon": getval("menu_icon"),
                "menu_endpoint": getval("menu_endpoint"),
                "menu_position": getval("menu_position"),
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
                $.post("<?= base_url("menus/data/delete") ?>", {
                    "menu_id": id,
                }, function(data) {
                    Swal.fire(
                        'Removed!',
                        'Menu has been deleted from System.',
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
                $("div.dataTables_filter").append('<button <?= ($permission->c ? "" : "disabled") ?> type="button" class="btn btn-sm ms-1 btn-primary" style="vertical-align: baseline;" onclick="create();" data-coreui-toggle="tooltip" data-coreui-placement="bottom" title="Create new Entry"><i class="fas fa-plus"></i></button>');
                appLoadTooltip();
            },
            "order": [
                [2, 'asc']
            ],
            ajax: {
                url: '<?= base_url("menus/data/lista/" . $privi->id) ?><?= (isset($sub) && $sub)?"/$sub->id":"" ?>',
                dataSrc: 'data',
            },
            "fnDrawCallback": function() {
                appLoadTooltip();
            },
            columns: [{
                    data: 'menu_icon'
                },
                {
                    data: 'menu_name',
                    render: dthtmlspecialchars,
                },
                {
                    data: 'menu_position'
                },
                {
                    data: 'updated_at'
                },
                {
                    data: 'id',
                    render: function(data, type, row) {
                        return `
                            <button <?= ($permission->u ? "" : "disabled") ?> class="btn text-white btn-sm btn-success me-2" onclick="edit(this)" href="<?= base_url("menus/edit/") ?>${data}" data-coreui-toggle="tooltip" data-coreui-placement="bottom" title="Edit"><i class="fas fa-pencil-alt"></i></button>
                            <?php if(!isset($sub) || $sub==""){ ?><a class="btn text-white btn-sm btn-info me-2" href="<?= base_url("menus/show/" . $privi->id) ?>/${data}" data-coreui-toggle="tooltip" data-coreui-placement="bottom" title="Edit Submenu"><i class="far fa-bars"></i></a> <?php } ?>
                            <button <?= ($permission->d ? "" : "disabled") ?> class="btn text-white btn-sm btn-danger" onclick="remove(${data})" href="#" data-coreui-toggle="tooltip" data-coreui-placement="bottom" title="Delete"><i class="far fa-trash-alt"></i></button>`;
                    }
                },
            ]
        });
    });
</script>