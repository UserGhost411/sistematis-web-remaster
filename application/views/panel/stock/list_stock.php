<div class="card mb-4">
    <div class="card-header"> Stock</a></div>
    <div class="card-body table-responsive">
        <table class="table table-striped border" id="companylist">
            <thead>
                <tr>
                    <th>Stock Name</th>
                    <th>Type</th>
                    <th>Location</th>
                    <th>Total</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>
<?php $this->load->view('include/modal', ["size" => "md", "title" => "Stock", "vertical" => true, "add_btn" => '<button type="button" class="btn btn-primary" onclick="save(this);">Save changes</button>']); ?>
<?php $this->load->view('include/modal', ["id" => "exchangeModal", "prefix" => "em", "size" => "lg", "title" => "History Exchange Stock", "vertical" => true, "add_btn" => '']); ?>

<script>
    let tdatable;

    function edit(btn) {
        $("#gm_title").html("Edit Stock");
        $.get($(btn).attr("href"), function(data) {
            $('#generalModal').modal('toggle')
            $("#gm_body").html(data);
            appLoadSelect2("#generalModal");
        });
    }

    function history(btn) {
        $("#em_title").html("Exchange Stock");
        $.get($(btn).attr("href"), function(data) {
            $('#exchangeModal').modal('toggle')
            $("#em_body").html(data);
            const aaa = $('#iolist').DataTable({
                ajax: {
                    url: `<?= base_url("stock/data/history") ?>/${$(btn).attr("d-id")}`,
                    dataSrc: 'data',
                },
                order: [
                    [3, 'asc']
                ],
                columns: [{
                        data: 'stock_reason'
                    },
                    {
                        data: 'stock_value',
                        render: function(data, type, row) {
                            return `${row.stock_status==1?`<span class="text-success"><i class="fas fa-plus"></i>`:`<span class="text-danger"><i class="fas fa-minus"></i>`} <b>${data}</b></span>`;
                        }
                    },
                    {
                        data: 'account_name'
                    },
                    {
                        data: 'created_at',
                        render: DataTable.render.datetime('DD/MM/YYYY HH:mm:ss'),
                    },
                ]
            });
        });
    }

    function exchange(btn) {
        $("#gm_title").html("Exchange Stock");
        $.get($(btn).attr("href"), function(data) {
            $('#generalModal').modal('toggle')
            $("#gm_body").html(data);
        });
    }

    function create() {
        $("#gm_title").html("Create new Stock");
        $.get("<?= base_url("stock/create") ?>", function(data) {
            $('#generalModal').modal('toggle')
            $("#gm_body").html(data);
            appLoadSelect2("#generalModal");
        });
    }

    function save(btn) {
        const btn_real = btn.innerHTML;
        btn.innerHTML = `<i class="fas fa-spinner-third fa-spin"></i>`;
        if (getval("stock_id") == "") {
            $.post("<?= base_url("stock/data/add") ?>", {
                "stock_name": getval("stock_name"),
                "stock_desc": getval("stock_desc"),
                "stock_location": getval("stock_location"),
                "stock_type": getval("stock_type"),
                "stock_total": getval("stock_total"),

            }, function(data) {
                $('#generalModal').modal('hide')
                $("#gm_body").html("");
                btn.innerHTML = btn_real;
                tdatable.ajax.reload(null, false);
            });
        } else {
            if (getval("stock_status") != "") {
                if (getval("stock_total") == 0) {
                    btn.innerHTML = btn_real;
                    Swal.fire(
                        'Invalid!',
                        'Please Enter Stock Exchange Value.',
                        'error'
                    )
                    return;
                }
                $.post("<?= base_url("stock/data/exchange") ?>", {
                    "stock_id": getval("stock_id"),
                    "stock_total": getval("stock_total"),
                    "stock_status": getval("stock_status"),
                    "stock_reason": getval("stock_reason"),
                }, function(data) {
                    $('#generalModal').modal('hide')
                    $("#gm_body").html("");
                    btn.innerHTML = btn_real;
                    tdatable.ajax.reload(null, false);
                });
            } else {
                $.post("<?= base_url("stock/data/edit") ?>", {
                    "stock_id": getval("stock_id"),
                    "stock_name": getval("stock_name"),
                    "stock_desc": getval("stock_desc"),
                    "stock_location": getval("stock_location"),
                    "stock_type": getval("stock_type"),
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
                $.post("<?= base_url("stock/data/delete") ?>", {
                    "stock_id": id,
                }, function(data) {
                    Swal.fire(
                        'Removed!',
                        'Stock has been deleted from System.',
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
            ajax: {
                url: '<?= base_url("stock/data/list") ?>',
                dataSrc: 'data',
            },
            "fnDrawCallback": function() {
                appLoadTooltip();
            },
            columns: [{
                    data: 'stock_name',
                    render: dthtmlspecialchars,
                },
                {
                    data: 'stock_type_name',
                    render: dthtmlspecialchars,
                },
                {
                    data: 'stock_location',
                    render: dthtmlspecialchars,
                },
                {
                    data: 'total_stock'
                },
                {
                    data: 'id',
                    render: function(data, type, row) {
                        return `
                            <button <?= ($permission->u ? "" : "disabled") ?> class="btn text-white btn-sm btn-success me-2" onclick="edit(this)" href="<?= base_url("stock/edit/") ?>${data}" data-coreui-toggle="tooltip" data-coreui-placement="bottom" title="Edit"><i class="fas fa-pencil-alt"></i></button>
                            <button <?= ($permission->u ? "" : "disabled") ?> class="btn text-white btn-sm btn-warning me-2" onclick="exchange(this)" href="<?= base_url("stock/io/") ?>${data}" data-coreui-toggle="tooltip" data-coreui-placement="bottom" title="Stock Exchange"><i class="fad fa-exchange"></i></button>
                            <button <?= ($permission->r ? "" : "disabled") ?> class="btn text-white btn-sm btn-info me-2" onclick="history(this)" href="<?= base_url("stock/history/") ?>${data}" d-id="${data}" data-coreui-toggle="tooltip" data-coreui-placement="bottom" title="Stock History"><i class="fad fa-history"></i></button>
                            <button <?= ($permission->d ? "" : "disabled") ?> class="btn text-white btn-sm btn-danger" onclick="remove(${data})" href="#" data-coreui-toggle="tooltip" data-coreui-placement="bottom" title="Delete"><i class="far fa-trash-alt"></i></button>`;
                    }
                },
            ]
        });
    });
</script>