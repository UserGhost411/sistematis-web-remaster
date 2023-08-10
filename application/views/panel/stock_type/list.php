<div class="card mb-4">
    <div class="card-header"> Stock types Management</a></div>
    <div class="card-body table-responsive">
        <table class="table table-striped border" id="privilist">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Stock Type Name</th>
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
        $("#gm_title").html("Edit Stock Type");
        $.get($(btn).attr("href"), function(data) {
            $('#generalModal').modal('toggle')
            $("#gm_body").html(data);
        });
    }

    function create() {
        $("#gm_title").html("Create Stock Type");
        $.get("<?= base_url("stockcat/create") ?>", function(data) {
            $('#generalModal').modal('toggle')
            $("#gm_body").html(data);
        });
    }

    function save(btn) {
        const btn_real = btn.innerHTML;
        btn.innerHTML = `<i class="fas fa-spinner-third fa-spin"></i>`;
        if (getval("stock_type_id") == "") {
            $.post("<?= base_url("stockcat/data/add") ?>", {
                "stock_type_name": getval("stock_type_name"),
            }, function(data) {
                $('#generalModal').modal('hide')
                $("#gm_body").html("");
                btn.innerHTML = btn_real;
                tdatable.ajax.reload(null, false);
            });
        } else {
            $.post("<?= base_url("stockcat/data/edit") ?>", {
                "stock_type_id": getval("stock_type_id"),
                "stock_type_name": getval("stock_type_name"),
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
                $.post("<?= base_url("stockcat/data/delete") ?>", {
                    "stock_type_id": id,
                }, function(data) {
                    Swal.fire(
                        'Removed!',
                        'Stock Type has been deleted from System.',
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
        tdatable = $('#privilist').DataTable({
            "initComplete": function(settings, json) {
                $("div.dataTables_filter").append('<button <?= ($permission->c ? "" : "disabled") ?> type="button" class="btn btn-sm ms-1 btn-primary" style="vertical-align: baseline;" onclick="create();" data-coreui-toggle="tooltip" data-coreui-placement="bottom" title="Create new Entry"><i class="fas fa-plus"></i></button>');
                appLoadTooltip();
            },
            ajax: {
                url: '<?= base_url("stockcat/data/list") ?>',
                dataSrc: 'data',
            },
            "fnDrawCallback": function() {
                appLoadTooltip();
            },
            columns: [
                {
                    data: 'id',
                    render: function(data, type, row) {
                        return data;
                    }
                },
                {
                    data: 'stock_type_name',
                    render: dthtmlspecialchars,
                },
                {
                    data: 'id',
                    render: function(data, type, row) {
                        return `
                            <button <?= ($permission->u ? "" : "disabled") ?> class="btn text-white btn-sm btn-success me-2" onclick="edit(this)" href="<?= base_url("stockcat/edit/") ?>${data}" data-coreui-toggle="tooltip" data-coreui-placement="bottom" title="Edit"><i class="fas fa-pencil-alt"></i></button>
                            <button <?= ($permission->d ? "" : "disabled") ?> class="btn text-white btn-sm btn-danger" onclick="remove(${data})" href="#" data-coreui-toggle="tooltip" data-coreui-placement="bottom" title="Delete"><i class="far fa-trash-alt"></i></button>
                            `;
                    }
                },
            ]
        });
    });
</script>